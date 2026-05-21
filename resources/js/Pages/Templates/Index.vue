<script setup lang="ts">
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link, router } from '@inertiajs/vue3';

defineProps<{
    templates: Array<{
        id: number;
        name: string;
        description: string | null;
        sections_count: number;
        is_global: boolean;
        created_at: string;
    }>;
}>();

const deleteTemplate = (id: number) => {
    if (confirm('Tem certeza que deseja excluir este modelo?')) {
        router.delete(route('templates.destroy', id));
    }
};
</script>

<template>
    <Head title="Modelos de Checklist - CheckLaudo" />

    <AuthenticatedLayout>
        <template #header>
            <div class="flex items-center justify-between">
                <h2 class="text-xl font-semibold leading-tight text-gray-800">
                    Modelos de Checklist
                </h2>
                <Link :href="route('templates.create')" class="px-4 py-2 bg-indigo-600 text-white text-sm font-medium rounded-lg hover:bg-indigo-700 transition-colors shadow-sm shadow-indigo-500/30">
                    Novo Modelo
                </Link>
            </div>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <!-- Template Card -->
                    <div v-for="template in templates" :key="template.id" class="bg-white shadow-sm sm:rounded-2xl border border-slate-200 overflow-hidden hover:shadow-md transition-shadow flex flex-col h-full">
                        <div class="p-6 flex-1 flex flex-col">
                            <div class="flex items-start justify-between mb-4">
                                <div class="w-10 h-10 bg-indigo-50 rounded-lg flex items-center justify-center text-indigo-600">
                                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" /></svg>
                                </div>
                                <span v-if="template.is_global" class="px-2.5 py-1 text-xs font-medium bg-emerald-100 text-emerald-800 rounded-full">Global</span>
                            </div>
                            
                            <h3 class="text-lg font-bold text-slate-900 mb-2">{{ template.name }}</h3>
                            <p class="text-sm text-slate-500 mb-6 flex-1 line-clamp-3">{{ template.description || 'Sem descrição' }}</p>
                            
                            <div class="flex items-center text-sm text-slate-500 gap-4 mb-6">
                                <span class="flex items-center gap-1">
                                    <svg class="w-4 h-4 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16" /></svg>
                                    {{ template.sections_count }} seções
                                </span>
                            </div>
                        </div>
                        
                        <div class="bg-slate-50 px-6 py-4 border-t border-slate-100 flex items-center justify-between">
                            <button v-if="!template.is_global" @click="deleteTemplate(template.id)" class="text-sm text-slate-500 hover:text-red-600 font-medium transition-colors">
                                Excluir
                            </button>
                            <span v-else class="text-sm text-slate-400">Somente leitura</span>
                            
                            <div class="flex gap-2">
                                <Link :href="route('templates.edit', template.id)" class="px-4 py-2 bg-white border border-slate-200 text-slate-700 text-sm font-medium rounded-lg hover:bg-slate-50 transition-colors">
                                    {{ template.is_global ? 'Ver Modelo' : 'Editar / Construtor' }}
                                </Link>
                            </div>
                        </div>
                    </div>

                    <!-- Empty State -->
                    <div v-if="templates.length === 0" class="col-span-full bg-white p-12 text-center rounded-2xl border border-slate-200">
                        <div class="w-16 h-16 bg-slate-50 rounded-2xl flex items-center justify-center mx-auto mb-4 text-slate-400">
                            <svg class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 13h6m-3-3v6m5 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" /></svg>
                        </div>
                        <h3 class="text-lg font-bold text-slate-900 mb-2">Nenhum modelo criado</h3>
                        <p class="text-slate-500 max-w-md mx-auto mb-6">Você ainda não tem modelos de checklist. Crie um modelo para começar a gerar relatórios estruturados.</p>
                        <Link :href="route('templates.create')" class="px-4 py-2 bg-indigo-600 text-white text-sm font-medium rounded-lg hover:bg-indigo-700 transition-colors inline-block shadow-sm">
                            Criar Primeiro Modelo
                        </Link>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
