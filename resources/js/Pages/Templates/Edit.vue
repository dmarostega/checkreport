<script setup lang="ts">
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, useForm, Link } from '@inertiajs/vue3';
import { ref } from 'vue';

const props = defineProps<{
    template: {
        id: number;
        name: string;
        description: string | null;
        is_global: boolean;
        sections: Array<{
            id: number;
            title: string;
            order: number;
            fields: Array<{
                id: number;
                type: string;
                label: string;
                options: any;
                is_required: boolean;
                order: number;
            }>;
        }>;
    }
}>();

// Form to update just the name/description
const basicForm = useForm({
    name: props.template.name,
    description: props.template.description || '',
    icon: '',
    color: '',
});

// Form to update structure
const structureForm = useForm({
    sections: JSON.parse(JSON.stringify(props.template.sections || []))
});

const fieldTypes = [
    { value: 'text', label: 'Texto Curto' },
    { value: 'textarea', label: 'Texto Longo' },
    { value: 'boolean', label: 'Sim/Não' },
    { value: 'select', label: 'Seleção Única' },
    { value: 'photo', label: 'Foto/Imagem' },
    { value: 'date', label: 'Data' },
];

const addSection = () => {
    structureForm.sections.push({
        id: null,
        title: 'Nova Seção',
        order: structureForm.sections.length,
        fields: []
    });
};

const removeSection = (index: number) => {
    if (confirm('Remover esta seção apagará todas as perguntas nela. Confirmar?')) {
        structureForm.sections.splice(index, 1);
        reorderSections();
    }
};

const addField = (sectionIndex: number) => {
    structureForm.sections[sectionIndex].fields.push({
        id: null,
        type: 'text',
        label: 'Nova Pergunta',
        options: null,
        is_required: false,
        order: structureForm.sections[sectionIndex].fields.length
    });
};

const removeField = (sectionIndex: number, fieldIndex: number) => {
    structureForm.sections[sectionIndex].fields.splice(fieldIndex, 1);
    reorderFields(sectionIndex);
};

const moveSection = (index: number, direction: number) => {
    const newIndex = index + direction;
    if (newIndex < 0 || newIndex >= structureForm.sections.length) return;
    const temp = structureForm.sections[index];
    structureForm.sections[index] = structureForm.sections[newIndex];
    structureForm.sections[newIndex] = temp;
    reorderSections();
};

const moveField = (sectionIndex: number, fieldIndex: number, direction: number) => {
    const fields = structureForm.sections[sectionIndex].fields;
    const newIndex = fieldIndex + direction;
    if (newIndex < 0 || newIndex >= fields.length) return;
    const temp = fields[fieldIndex];
    fields[fieldIndex] = fields[newIndex];
    fields[newIndex] = temp;
    reorderFields(sectionIndex);
};

const reorderSections = () => {
    structureForm.sections.forEach((sec: any, i: number) => sec.order = i);
};

const reorderFields = (sectionIndex: number) => {
    structureForm.sections[sectionIndex].fields.forEach((f: any, i: number) => f.order = i);
};

const saveBasic = () => {
    basicForm.put(route('templates.update', props.template.id));
};

const saveStructure = () => {
    structureForm.post(route('templates.structure.update', props.template.id), {
        preserveScroll: true
    });
};

const activeTab = ref('structure');
</script>

<template>
    <Head :title="`Editar Modelo: ${template.name} - CheckLaudo`" />

    <AuthenticatedLayout>
        <template #header>
            <div class="flex items-center justify-between">
                <div class="flex items-center gap-4">
                    <Link :href="route('templates.index')" class="text-slate-400 hover:text-slate-600">
                        <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" /></svg>
                    </Link>
                    <h2 class="text-xl font-semibold leading-tight text-gray-800">
                        {{ template.name }} <span v-if="template.is_global" class="ml-2 px-2 py-0.5 text-xs bg-emerald-100 text-emerald-800 rounded-full">Global</span>
                    </h2>
                </div>
                <div class="flex gap-2" v-if="!template.is_global">
                    <button @click="saveStructure" :disabled="structureForm.processing" class="px-5 py-2 bg-indigo-600 text-white text-sm font-medium rounded-lg hover:bg-indigo-700 transition-colors shadow-sm disabled:opacity-50 flex items-center gap-2">
                        <svg v-if="structureForm.processing" class="animate-spin -ml-1 mr-2 h-4 w-4 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>
                        Salvar Alterações
                    </button>
                </div>
            </div>
        </template>

        <div class="py-8">
            <div class="mx-auto max-w-5xl sm:px-6 lg:px-8">
                <!-- Tabs -->
                <div class="flex space-x-4 border-b border-slate-200 mb-8 px-4 sm:px-0">
                    <button @click="activeTab = 'structure'" :class="{'border-indigo-600 text-indigo-600': activeTab === 'structure', 'border-transparent text-slate-500 hover:text-slate-700': activeTab !== 'structure'}" class="pb-3 border-b-2 font-medium text-sm transition-colors">
                        Construtor
                    </button>
                    <button @click="activeTab = 'config'" :class="{'border-indigo-600 text-indigo-600': activeTab === 'config', 'border-transparent text-slate-500 hover:text-slate-700': activeTab !== 'config'}" class="pb-3 border-b-2 font-medium text-sm transition-colors">
                        Configurações
                    </button>
                </div>

                <!-- Config Tab -->
                <div v-if="activeTab === 'config'" class="bg-white shadow-sm sm:rounded-2xl border border-slate-200 overflow-hidden p-8">
                    <form @submit.prevent="saveBasic" class="space-y-6">
                        <div>
                            <label class="block font-medium text-sm text-gray-700">Nome do Modelo</label>
                            <input type="text" v-model="basicForm.name" :disabled="template.is_global" class="mt-1 block w-full border-slate-300 rounded-md shadow-sm disabled:bg-slate-50" />
                        </div>
                        <div>
                            <label class="block font-medium text-sm text-gray-700">Descrição</label>
                            <textarea v-model="basicForm.description" :disabled="template.is_global" class="mt-1 block w-full border-slate-300 rounded-md shadow-sm disabled:bg-slate-50" rows="3"></textarea>
                        </div>
                        <div class="flex justify-end" v-if="!template.is_global">
                            <button type="submit" class="px-4 py-2 bg-slate-900 text-white text-sm font-medium rounded-lg hover:bg-slate-800 transition-colors">Atualizar Dados Básicos</button>
                        </div>
                    </form>
                </div>

                <!-- Structure Tab -->
                <div v-if="activeTab === 'structure'">
                    <div v-if="template.is_global" class="bg-blue-50 text-blue-800 p-4 rounded-xl mb-6 border border-blue-100 flex items-center gap-3">
                        <svg class="w-5 h-5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                        <p class="text-sm">Este é um modelo global e não pode ser editado. Para usá-lo, crie um novo relatório e selecione este modelo.</p>
                    </div>

                    <div class="space-y-8">
                        <div v-for="(section, sIdx) in structureForm.sections" :key="sIdx" class="bg-white shadow-sm rounded-2xl border border-slate-200 overflow-hidden transition-all">
                            <!-- Section Header -->
                            <div class="bg-slate-50 px-6 py-4 border-b border-slate-200 flex items-center justify-between gap-4">
                                <div class="flex items-center gap-3 flex-1">
                                    <div class="flex flex-col gap-1" v-if="!template.is_global">
                                        <button @click="moveSection(sIdx, -1)" :disabled="sIdx === 0" class="text-slate-400 hover:text-indigo-600 disabled:opacity-30"><svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7" /></svg></button>
                                        <button @click="moveSection(sIdx, 1)" :disabled="sIdx === structureForm.sections.length - 1" class="text-slate-400 hover:text-indigo-600 disabled:opacity-30"><svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" /></svg></button>
                                    </div>
                                    <input v-model="section.title" :disabled="template.is_global" type="text" class="font-bold text-lg text-slate-900 border-transparent bg-transparent hover:bg-white hover:border-slate-300 focus:bg-white focus:border-indigo-500 rounded px-2 py-1 w-full md:w-1/2 transition-colors disabled:hover:bg-transparent disabled:hover:border-transparent" placeholder="Nome da Seção" />
                                </div>
                                <button v-if="!template.is_global" @click="removeSection(sIdx)" class="text-red-500 hover:text-red-700 p-2 rounded-lg hover:bg-red-50 transition-colors" title="Excluir Seção">
                                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                                </button>
                            </div>

                            <!-- Fields List -->
                            <div class="p-6 space-y-4">
                                <div v-for="(field, fIdx) in section.fields" :key="fIdx" class="flex gap-4 items-start bg-slate-50 border border-slate-200 rounded-xl p-4">
                                    <div class="flex flex-col gap-1 mt-1" v-if="!template.is_global">
                                        <button @click="moveField(sIdx, fIdx, -1)" :disabled="fIdx === 0" class="text-slate-400 hover:text-indigo-600 disabled:opacity-30"><svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7" /></svg></button>
                                        <button @click="moveField(sIdx, fIdx, 1)" :disabled="fIdx === section.fields.length - 1" class="text-slate-400 hover:text-indigo-600 disabled:opacity-30"><svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" /></svg></button>
                                    </div>
                                    <div class="flex-1 grid grid-cols-1 md:grid-cols-12 gap-4">
                                        <div class="col-span-12 md:col-span-6">
                                            <label class="block text-xs font-medium text-slate-500 mb-1">Pergunta / Rótulo</label>
                                            <input v-model="field.label" :disabled="template.is_global" type="text" class="w-full border-slate-300 rounded-lg text-sm shadow-sm" placeholder="Ex: Qual o estado do filtro?" />
                                        </div>
                                        <div class="col-span-6 md:col-span-3">
                                            <label class="block text-xs font-medium text-slate-500 mb-1">Tipo de Resposta</label>
                                            <select v-model="field.type" :disabled="template.is_global" class="w-full border-slate-300 rounded-lg text-sm shadow-sm">
                                                <option v-for="t in fieldTypes" :key="t.value" :value="t.value">{{ t.label }}</option>
                                            </select>
                                        </div>
                                        <div class="col-span-6 md:col-span-3 flex items-center justify-between">
                                            <label class="flex items-center gap-2 mt-6 cursor-pointer">
                                                <input type="checkbox" v-model="field.is_required" :disabled="template.is_global" class="rounded border-slate-300 text-indigo-600 shadow-sm focus:ring-indigo-500" />
                                                <span class="text-sm text-slate-600 font-medium">Obrigatório</span>
                                            </label>
                                            <button v-if="!template.is_global" @click="removeField(sIdx, fIdx)" class="mt-5 text-slate-400 hover:text-red-500 p-1 rounded-md hover:bg-slate-200 transition-colors" title="Remover Pergunta">
                                                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
                                            </button>
                                        </div>
                                        
                                        <!-- Options for Select -->
                                        <div class="col-span-12" v-if="field.type === 'select'">
                                            <label class="block text-xs font-medium text-slate-500 mb-1">Opções (separadas por vírgula)</label>
                                            <input v-model="field.options" :disabled="template.is_global" type="text" class="w-full border-slate-300 rounded-lg text-sm shadow-sm" placeholder="Ex: Bom, Regular, Ruim, Péssimo" />
                                        </div>
                                    </div>
                                </div>
                                
                                <div v-if="section.fields.length === 0" class="text-center py-6 text-slate-400 text-sm border-2 border-dashed border-slate-200 rounded-xl">
                                    Nenhuma pergunta nesta seção.
                                </div>

                                <button v-if="!template.is_global" @click="addField(sIdx)" class="w-full py-3 border-2 border-dashed border-indigo-200 text-indigo-600 font-medium rounded-xl hover:bg-indigo-50 hover:border-indigo-300 transition-colors flex items-center justify-center gap-2 text-sm">
                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" /></svg>
                                    Adicionar Pergunta
                                </button>
                            </div>
                        </div>

                        <div class="pt-4" v-if="!template.is_global">
                            <button @click="addSection" class="w-full py-4 bg-white border border-slate-300 text-slate-700 font-medium rounded-2xl hover:bg-slate-50 transition-colors shadow-sm flex items-center justify-center gap-2">
                                <svg class="w-5 h-5 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" /></svg>
                                Adicionar Nova Seção
                            </button>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </AuthenticatedLayout>
</template>
