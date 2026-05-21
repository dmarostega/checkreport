<script setup lang="ts">
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link, router } from '@inertiajs/vue3';

defineProps<{
    reports: Array<{
        id: number;
        status: string;
        token: string;
        created_at: string;
        customer: { name: string } | null;
        template: { name: string };
    }>;
}>();

const formatDate = (dateString: string) => {
    return new Date(dateString).toLocaleDateString('pt-BR', { day: '2-digit', month: '2-digit', year: 'numeric', hour: '2-digit', minute: '2-digit' });
};

const deleteReport = (id: number) => {
    if (confirm('Deseja realmente apagar este relatório?')) {
        router.delete(route('reports.destroy', id));
    }
};
</script>

<template>
    <Head title="Meus Relatórios - CheckLaudo" />

    <AuthenticatedLayout>
        <template #header>
            <div class="flex items-center justify-between">
                <h2 class="text-xl font-semibold leading-tight text-gray-800">
                    Meus Relatórios / Vistorias
                </h2>
                <Link :href="route('reports.create')" class="px-4 py-2 bg-indigo-600 text-white text-sm font-medium rounded-lg hover:bg-indigo-700 transition-colors shadow-sm shadow-indigo-500/30">
                    Novo Relatório
                </Link>
            </div>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="bg-white shadow-sm sm:rounded-2xl border border-slate-200 overflow-hidden">
                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr class="bg-slate-50 border-b border-slate-200 text-slate-500 text-sm">
                                    <th class="p-4 font-medium">Data</th>
                                    <th class="p-4 font-medium">Modelo</th>
                                    <th class="p-4 font-medium hidden sm:table-cell">Cliente</th>
                                    <th class="p-4 font-medium">Status</th>
                                    <th class="p-4 font-medium text-right">Ações</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-100">
                                <tr v-for="report in reports" :key="report.id" class="hover:bg-slate-50 transition-colors">
                                    <td class="p-4 text-slate-600 text-sm">{{ formatDate(report.created_at) }}</td>
                                    <td class="p-4 font-medium text-slate-900">{{ report.template.name }}</td>
                                    <td class="p-4 text-slate-600 hidden sm:table-cell">{{ report.customer?.name || 'Sem cliente' }}</td>
                                    <td class="p-4">
                                        <span v-if="report.status === 'draft'" class="px-2.5 py-1 text-xs font-medium bg-amber-100 text-amber-800 rounded-full">Rascunho</span>
                                        <span v-else class="px-2.5 py-1 text-xs font-medium bg-emerald-100 text-emerald-800 rounded-full">Concluído</span>
                                    </td>
                                    <td class="p-4 text-right space-x-3">
                                        <Link :href="route('reports.show', report.id)" class="text-sm text-indigo-600 hover:text-indigo-900 font-medium">
                                            {{ report.status === 'draft' ? 'Continuar' : 'Visualizar' }}
                                        </Link>
                                        <a v-if="report.status === 'completed'" :href="route('reports.pdf', report.id)" target="_blank" class="text-sm text-slate-600 hover:text-slate-900 font-medium">
                                            PDF
                                        </a>
                                        <button @click="deleteReport(report.id)" class="text-sm text-red-600 hover:text-red-900 font-medium">
                                            Excluir
                                        </button>
                                    </td>
                                </tr>
                                <tr v-if="reports.length === 0">
                                    <td colspan="5" class="p-8 text-center text-slate-500">
                                        Nenhum relatório criado ainda.<br/>
                                        <Link :href="route('reports.create')" class="text-indigo-600 font-medium hover:underline mt-2 inline-block">Criar meu primeiro relatório</Link>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
