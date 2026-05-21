<script setup lang="ts">
import { Head } from '@inertiajs/vue3';
import PublicLayout from '@/Layouts/PublicLayout.vue';

const props = defineProps<{
    report: {
        id: number;
        status: string;
        token: string;
        created_at: string;
        customer: { name: string } | null;
        user: { name: string, email: string };
        template: {
            name: string;
            sections: Array<{
                id: number;
                title: string;
                fields: Array<{
                    id: number;
                    type: string;
                    label: string;
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
        }>;
    }
}>();

const getAnswer = (fieldId: number) => {
    const answer = props.report.answers.find(a => a.checklist_field_id === fieldId);
    return answer ? answer.value : '-';
};

const getPhotos = (fieldId: number) => {
    return props.report.photos.filter(p => p.checklist_field_id === fieldId);
};

const formatDate = (dateString: string) => {
    return new Date(dateString).toLocaleDateString('pt-BR', { day: '2-digit', month: '2-digit', year: 'numeric' });
};
</script>

<template>
    <Head :title="`${report.template.name} - Laudo Público`" />

    <PublicLayout>
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            
            <div class="bg-white rounded-3xl border border-slate-200 shadow-sm overflow-hidden print:shadow-none print:border-none">
                <!-- Header / Capa -->
                <div class="bg-slate-900 text-white p-8 md:p-12">
                    <h1 class="text-3xl font-black mb-2">{{ report.template.name }}</h1>
                    <p class="text-slate-400">ID do Laudo: #{{ report.id.toString().padStart(6, '0') }}</p>
                    
                    <div class="mt-8 grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <span class="block text-sm text-slate-400 uppercase tracking-wider font-bold mb-1">Cliente / Local</span>
                            <span class="text-lg font-medium">{{ report.customer ? report.customer.name : 'N/A' }}</span>
                        </div>
                        <div>
                            <span class="block text-sm text-slate-400 uppercase tracking-wider font-bold mb-1">Responsável Técnico</span>
                            <span class="text-lg font-medium">{{ report.user.name }}</span>
                            <span class="block text-sm text-slate-400">{{ report.user.email }}</span>
                        </div>
                        <div>
                            <span class="block text-sm text-slate-400 uppercase tracking-wider font-bold mb-1">Data de Emissão</span>
                            <span class="text-lg font-medium">{{ formatDate(report.created_at) }}</span>
                        </div>
                    </div>
                </div>

                <!-- Conteúdo -->
                <div class="p-8 md:p-12 space-y-12 bg-white">
                    <div v-for="section in report.template.sections" :key="section.id" class="print:break-inside-avoid">
                        <h2 class="text-xl font-bold text-slate-900 mb-6 pb-2 border-b-2 border-slate-100">{{ section.title }}</h2>
                        
                        <div class="space-y-6">
                            <div v-for="field in section.fields" :key="field.id" class="bg-slate-50 rounded-xl p-4 border border-slate-100">
                                <span class="block text-sm text-slate-500 font-bold mb-1">{{ field.label }}</span>
                                
                                <div v-if="field.type === 'photo'" class="mt-3 flex flex-wrap gap-4">
                                    <div v-for="photo in getPhotos(field.id)" :key="photo.id" class="w-48 h-48 rounded-lg overflow-hidden border border-slate-200">
                                        <img :src="`/storage/${photo.file_path}`" class="w-full h-full object-cover" />
                                    </div>
                                    <span v-if="getPhotos(field.id).length === 0" class="text-slate-400 italic">Nenhuma foto anexada.</span>
                                </div>
                                <div v-else>
                                    <span class="text-slate-900 font-medium whitespace-pre-wrap">{{ getAnswer(field.id) }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Footer -->
                <div class="bg-slate-50 p-8 border-t border-slate-200 text-center text-slate-500 text-sm">
                    Este documento foi gerado através do CheckLaudo e a responsabilidade pelas informações contidas é exclusiva do responsável técnico informado acima.
                </div>
            </div>

        </div>
    </PublicLayout>
</template>
