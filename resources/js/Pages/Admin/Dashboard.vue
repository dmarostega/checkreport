<script setup lang="ts">
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link } from '@inertiajs/vue3';
</script>

<template>
    <Head title="Admin Dashboard - CheckLaudo" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                Painel de Controle Admin
            </h2>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8 space-y-6">
                
                <div class="bg-indigo-600 rounded-3xl p-8 text-white shadow-lg">
                    <h3 class="text-2xl font-black mb-2">Visão Geral</h3>
                    <p class="text-indigo-200">Bem-vindo ao centro de comando do CheckLaudo SaaS.</p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <Link :href="route('admin.users.index')" class="bg-white overflow-hidden shadow-sm sm:rounded-2xl p-6 border border-slate-200 hover:border-indigo-300 hover:shadow-md transition-all group flex items-center gap-4">
                        <div class="w-12 h-12 bg-indigo-50 rounded-xl flex items-center justify-center text-indigo-600 group-hover:bg-indigo-600 group-hover:text-white transition-colors">
                            <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" /></svg>
                        </div>
                        <div>
                            <h4 class="text-lg font-semibold text-slate-900">Gerenciar Usuários</h4>
                            <p class="text-sm text-slate-500">Altere níveis de acesso e planos assinados manualmente.</p>
                        </div>
                    </Link>

                    <Link :href="route('admin.plans.index')" class="bg-white overflow-hidden shadow-sm sm:rounded-2xl p-6 border border-slate-200 hover:border-indigo-300 hover:shadow-md transition-all group flex items-center gap-4">
                        <div class="w-12 h-12 bg-indigo-50 rounded-xl flex items-center justify-center text-indigo-600 group-hover:bg-indigo-600 group-hover:text-white transition-colors">
                            <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 002-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" /></svg>
                        </div>
                        <div>
                            <h4 class="text-lg font-semibold text-slate-900">Planos e Limites</h4>
                            <p class="text-sm text-slate-500">Configure limites de templates, PDFs e precificação.</p>
                        </div>
                    </Link>
                </div>

            </div>
        </div>
    </AuthenticatedLayout>
</template>
