<script setup lang="ts">
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, useForm, Link } from '@inertiajs/vue3';
import { ref } from 'vue';
import axios from 'axios';

const props = defineProps<{
    report: {
        id: number;
        status: string;
        token: string;
        customer: { name: string } | null;
        template: {
            name: string;
            sections: Array<{
                id: number;
                title: string;
                fields: Array<{
                    id: number;
                    type: string;
                    label: string;
                    options: string | null;
                    is_required: boolean;
                }>;
            }>;
        };
        answers: Array<{
            checklist_field_id: number;
            value: string;
        }>;
        photos: Array<{
            id: number;
            checklist_field_id: number | null;
            file_path: string;
            caption: string | null;
        }>;
    }
}>();

// Map initial answers
const initialAnswers: Record<number, any> = {};
props.report.answers.forEach(a => {
    initialAnswers[a.checklist_field_id] = a.value;
});

const form = useForm({
    status: props.report.status,
    answers: initialAnswers,
});

const parseOptions = (optionsStr: string | null) => {
    if (!optionsStr) return [];
    return optionsStr.split(',').map(s => s.trim());
};

const saveProgress = (status: 'draft' | 'completed') => {
    form.status = status;
    form.post(route('reports.answers.save', props.report.id), {
        preserveScroll: true,
        onSuccess: () => {
            if (status === 'completed') {
                // Could redirect or show success
            }
        }
    });
};

const photoUploadings = ref<Record<number, boolean>>({});

const uploadPhoto = async (fieldId: number | null, e: Event) => {
    const input = e.target as HTMLInputElement;
    if (!input.files || input.files.length === 0) return;

    const file = input.files[0];
    const formData = new FormData();
    formData.append('photo', file);
    if (fieldId) formData.append('checklist_field_id', fieldId.toString());

    try {
        if (fieldId) photoUploadings.value[fieldId] = true;
        const response = await axios.post(route('reports.photo.upload', props.report.id), formData, {
            headers: { 'Content-Type': 'multipart/form-data' }
        });
        
        // Em um app real, atualizaríamos a UI localmente ou recarregaríamos a prop
        window.location.reload(); 
    } catch (error) {
        alert('Erro ao fazer upload da foto.');
    } finally {
        if (fieldId) photoUploadings.value[fieldId] = false;
    }
};

const getPhotosForField = (fieldId: number) => {
    return props.report.photos.filter(p => p.checklist_field_id === fieldId);
};
</script>

<template>
    <Head :title="`Preencher: ${report.template.name} - CheckLaudo`" />

    <AuthenticatedLayout>
        <template #header>
            <div class="flex items-center justify-between">
                <div class="flex items-center gap-4">
                    <Link :href="route('reports.index')" class="text-slate-400 hover:text-slate-600">
                        <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" /></svg>
                    </Link>
                    <div>
                        <h2 class="text-xl font-semibold leading-tight text-gray-800">
                            {{ report.template.name }}
                        </h2>
                        <p class="text-sm text-slate-500 mt-1" v-if="report.customer">Cliente: {{ report.customer.name }}</p>
                    </div>
                </div>
                <div class="flex gap-2">
                    <button @click="saveProgress('draft')" :disabled="form.processing" class="px-4 py-2 bg-white border border-slate-200 text-slate-700 text-sm font-medium rounded-lg hover:bg-slate-50 transition-colors">
                        Salvar Rascunho
                    </button>
                    <button @click="saveProgress('completed')" :disabled="form.processing" class="px-5 py-2 bg-emerald-600 text-white text-sm font-medium rounded-lg hover:bg-emerald-700 transition-colors shadow-sm">
                        Concluir Vistoria
                    </button>
                </div>
            </div>
        </template>

        <div class="py-8">
            <div class="mx-auto max-w-3xl sm:px-6 lg:px-8 space-y-8">
                
                <div v-if="report.status === 'completed'" class="bg-blue-50 border border-blue-200 text-blue-800 rounded-xl p-4 flex justify-between items-center">
                    <div>
                        <h4 class="font-bold">Relatório Concluído</h4>
                        <p class="text-sm">Você pode alterar as respostas, mas o documento já pode ser exportado.</p>
                    </div>
                    <div class="flex gap-3">
                        <a :href="route('reports.pdf', report.id)" target="_blank" class="text-sm font-bold text-blue-700 hover:underline">PDF</a>
                        <a :href="route('public.report', report.token)" target="_blank" class="text-sm font-bold text-blue-700 hover:underline">Link Público</a>
                    </div>
                </div>

                <div v-for="section in report.template.sections" :key="section.id" class="bg-white shadow-sm rounded-2xl border border-slate-200 overflow-hidden">
                    <div class="bg-slate-50 px-6 py-4 border-b border-slate-200">
                        <h3 class="font-bold text-lg text-slate-900">{{ section.title }}</h3>
                    </div>
                    
                    <div class="p-6 space-y-8">
                        <div v-for="field in section.fields" :key="field.id" class="border-b border-slate-100 pb-6 last:border-0 last:pb-0">
                            <label class="block font-medium text-slate-800 mb-2">
                                {{ field.label }} <span v-if="field.is_required" class="text-red-500">*</span>
                            </label>

                            <!-- TEXT -->
                            <input v-if="field.type === 'text'" type="text" v-model="form.answers[field.id]" class="w-full border-slate-300 rounded-lg shadow-sm focus:border-indigo-500 focus:ring-indigo-500" />

                            <!-- TEXTAREA -->
                            <textarea v-else-if="field.type === 'textarea'" v-model="form.answers[field.id]" rows="3" class="w-full border-slate-300 rounded-lg shadow-sm focus:border-indigo-500 focus:ring-indigo-500"></textarea>

                            <!-- BOOLEAN -->
                            <div v-else-if="field.type === 'boolean'" class="flex gap-4 mt-2">
                                <label class="flex items-center gap-2 cursor-pointer p-3 border border-slate-200 rounded-xl hover:bg-slate-50 flex-1">
                                    <input type="radio" v-model="form.answers[field.id]" value="Sim" class="text-indigo-600 focus:ring-indigo-500" /> Sim
                                </label>
                                <label class="flex items-center gap-2 cursor-pointer p-3 border border-slate-200 rounded-xl hover:bg-slate-50 flex-1">
                                    <input type="radio" v-model="form.answers[field.id]" value="Não" class="text-indigo-600 focus:ring-indigo-500" /> Não
                                </label>
                            </div>

                            <!-- SELECT -->
                            <select v-else-if="field.type === 'select'" v-model="form.answers[field.id]" class="w-full border-slate-300 rounded-lg shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                <option value=""></option>
                                <option v-for="opt in parseOptions(field.options)" :key="opt" :value="opt">{{ opt }}</option>
                            </select>

                            <!-- DATE -->
                            <input v-else-if="field.type === 'date'" type="date" v-model="form.answers[field.id]" class="w-full border-slate-300 rounded-lg shadow-sm focus:border-indigo-500 focus:ring-indigo-500" />

                            <!-- PHOTO -->
                            <div v-else-if="field.type === 'photo'" class="mt-2 space-y-4">
                                <div class="flex flex-wrap gap-4">
                                    <div v-for="photo in getPhotosForField(field.id)" :key="photo.id" class="w-32 h-32 rounded-xl border border-slate-200 overflow-hidden relative group">
                                        <img :src="`/storage/${photo.file_path}`" class="w-full h-full object-cover" />
                                    </div>
                                    <label class="w-32 h-32 rounded-xl border-2 border-dashed border-slate-300 flex flex-col items-center justify-center text-slate-500 hover:bg-slate-50 hover:text-indigo-600 hover:border-indigo-300 cursor-pointer transition-colors relative">
                                        <svg v-if="!photoUploadings[field.id]" class="w-8 h-8 mb-1" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" /></svg>
                                        <svg v-else class="w-8 h-8 mb-1 animate-spin text-indigo-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>
                                        <span class="text-xs font-medium">{{ photoUploadings[field.id] ? 'Enviando...' : 'Adicionar Foto' }}</span>
                                        <input type="file" accept="image/*" class="hidden" @change="e => uploadPhoto(field.id, e)" :disabled="photoUploadings[field.id]" />
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </AuthenticatedLayout>
</template>
