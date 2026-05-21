<script setup lang="ts">
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link } from '@inertiajs/vue3';

defineProps<{
    metrics: {
        total_customers: number;
        total_templates: number;
        max_templates: number;
        reports_this_month: number;
        max_reports: number;
        plan_name: string;
        plan_tier: string;
    }
}>();
</script>

<template>
    <Head title="Dashboard - CheckLaudo" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                Dashboard
            </h2>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8 space-y-6">
                <!-- Plan Summary -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-2xl p-6 border border-slate-200">
                    <div class="flex items-center justify-between mb-6">
                        <div>
                            <h3 class="text-lg font-medium text-slate-900">Seu Plano: <span class="text-indigo-600 font-bold">{{ metrics.plan_name }}</span></h3>
                            <p class="text-sm text-slate-500">Limites e uso do mês atual.</p>
                        </div>
                        <Link v-if="metrics.plan_tier === 'free'" :href="route('pricing')" class="px-4 py-2 bg-indigo-50 text-indigo-700 text-sm font-medium rounded-lg hover:bg-indigo-100 transition-colors">
                            Fazer Upgrade
                        </Link>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <!-- Relatórios -->
                        <div class="bg-slate-50 rounded-xl p-5 border border-slate-100">
                            <div class="flex justify-between items-center mb-2">
                                <span class="text-sm font-medium text-slate-600">Relatórios (Mês)</span>
                                <svg class="w-5 h-5 text-indigo-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" /></svg>
                            </div>
                            <div class="flex items-end gap-2">
                                <span class="text-3xl font-bold text-slate-900">{{ metrics.reports_this_month }}</span>
                                <span class="text-sm text-slate-500 mb-1">/ {{ metrics.max_reports === -1 ? 'Ilimitado' : metrics.max_reports }}</span>
                            </div>
                            <div class="mt-3 w-full bg-slate-200 rounded-full h-1.5" v-if="metrics.max_reports !== -1">
                                <div class="bg-indigo-600 h-1.5 rounded-full" :style="`width: ${Math.min((metrics.reports_this_month / metrics.max_reports) * 100, 100)}%`"></div>
                            </div>
                        </div>

                        <!-- Templates -->
                        <div class="bg-slate-50 rounded-xl p-5 border border-slate-100">
                            <div class="flex justify-between items-center mb-2">
                                <span class="text-sm font-medium text-slate-600">Modelos de Checklist</span>
                                <svg class="w-5 h-5 text-indigo-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" /></svg>
                            </div>
                            <div class="flex items-end gap-2">
                                <span class="text-3xl font-bold text-slate-900">{{ metrics.total_templates }}</span>
                                <span class="text-sm text-slate-500 mb-1">/ {{ metrics.max_templates === -1 ? 'Ilimitado' : metrics.max_templates }}</span>
                            </div>
                            <div class="mt-3 w-full bg-slate-200 rounded-full h-1.5" v-if="metrics.max_templates !== -1">
                                <div class="bg-indigo-600 h-1.5 rounded-full" :style="`width: ${Math.min((metrics.total_templates / metrics.max_templates) * 100, 100)}%`"></div>
                            </div>
                        </div>

                        <!-- Clientes -->
                        <div class="bg-slate-50 rounded-xl p-5 border border-slate-100">
                            <div class="flex justify-between items-center mb-2">
                                <span class="text-sm font-medium text-slate-600">Clientes Cadastrados</span>
                                <svg class="w-5 h-5 text-indigo-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" /></svg>
                            </div>
                            <div class="flex items-end gap-2">
                                <span class="text-3xl font-bold text-slate-900">{{ metrics.total_customers }}</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Quick Actions -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <Link :href="route('customers.index')" class="bg-white overflow-hidden shadow-sm sm:rounded-2xl p-6 border border-slate-200 hover:border-indigo-300 hover:shadow-md transition-all group flex items-center gap-4">
                        <div class="w-12 h-12 bg-indigo-50 rounded-xl flex items-center justify-center text-indigo-600 group-hover:bg-indigo-600 group-hover:text-white transition-colors">
                            <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" /></svg>
                        </div>
                        <div>
                            <h4 class="text-lg font-semibold text-slate-900">Gerenciar Clientes</h4>
                            <p class="text-sm text-slate-500">Adicione e edite os clientes das suas vistorias.</p>
                        </div>
                    </Link>

                    <Link :href="route('templates.index')" class="bg-white overflow-hidden shadow-sm sm:rounded-2xl p-6 border border-slate-200 hover:border-indigo-300 hover:shadow-md transition-all group flex items-center gap-4">
                        <div class="w-12 h-12 bg-indigo-50 rounded-xl flex items-center justify-center text-indigo-600 group-hover:bg-indigo-600 group-hover:text-white transition-colors">
                            <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" /></svg>
                        </div>
                        <div>
                            <h4 class="text-lg font-semibold text-slate-900">Modelos de Checklist</h4>
                            <p class="text-sm text-slate-500">Crie ou edite seus templates customizados.</p>
                        </div>
                    </Link>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
