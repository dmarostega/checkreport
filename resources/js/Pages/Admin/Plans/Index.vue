<script setup lang="ts">
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link, router } from '@inertiajs/vue3';

defineProps<{
    plans: Array<{
        id: number;
        name: string;
        tier: string;
        price_monthly: number;
        max_templates: number;
        max_reports_per_month: number;
    }>;
}>();

const formatPrice = (price: number) => {
    return new Intl.NumberFormat('pt-BR', { style: 'currency', currency: 'BRL' }).format(price);
};

const deletePlan = (id: number) => {
    if (confirm('Atenção: Excluir um plano pode quebrar os usuários associados a ele. Continuar?')) {
        router.delete(route('admin.plans.destroy', id));
    }
};
</script>

<template>
    <Head title="Gerenciar Planos - CheckLaudo" />

    <AuthenticatedLayout>
        <template #header>
            <div class="flex items-center justify-between">
                <div class="flex items-center gap-4">
                    <Link :href="route('admin.dashboard')" class="text-slate-400 hover:text-slate-600">
                        <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" /></svg>
                    </Link>
                    <h2 class="text-xl font-semibold leading-tight text-gray-800">
                        Planos SaaS
                    </h2>
                </div>
                <Link :href="route('admin.plans.create')" class="px-4 py-2 bg-slate-900 text-white text-sm font-medium rounded-lg hover:bg-slate-800 transition-colors">
                    Adicionar Plano
                </Link>
            </div>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="bg-white shadow-sm sm:rounded-2xl border border-slate-200 overflow-hidden">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-slate-50 border-b border-slate-200 text-slate-500 text-sm">
                                <th class="p-4 font-medium">Plano / Nível</th>
                                <th class="p-4 font-medium">Preço (Mês)</th>
                                <th class="p-4 font-medium">Max Modelos</th>
                                <th class="p-4 font-medium">Max Relatórios</th>
                                <th class="p-4 font-medium text-right">Ações</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100">
                            <tr v-for="plan in plans" :key="plan.id" class="hover:bg-slate-50 transition-colors">
                                <td class="p-4 font-medium text-slate-900">
                                    {{ plan.name }}
                                    <span class="block text-xs font-normal text-slate-500 uppercase">{{ plan.tier }}</span>
                                </td>
                                <td class="p-4 font-bold text-slate-700">{{ formatPrice(plan.price_monthly) }}</td>
                                <td class="p-4 text-slate-600">{{ plan.max_templates === -1 ? 'Ilimitado' : plan.max_templates }}</td>
                                <td class="p-4 text-slate-600">{{ plan.max_reports_per_month === -1 ? 'Ilimitado' : plan.max_reports_per_month }}</td>
                                <td class="p-4 text-right space-x-3">
                                    <Link :href="route('admin.plans.edit', plan.id)" class="text-sm text-indigo-600 hover:text-indigo-900 font-medium">
                                        Editar
                                    </Link>
                                    <button @click="deletePlan(plan.id)" class="text-sm text-red-600 hover:text-red-900 font-medium">
                                        Excluir
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
