<script setup lang="ts">
import { Head, Link } from '@inertiajs/vue3';
import PublicLayout from '@/Layouts/PublicLayout.vue';

const baseUrl = 'https://checkreport.app';
const title = 'Recursos - CheckLaudo';
const description = 'Conheça todos os recursos do CheckLaudo: modelos customizáveis, upload de fotos, geração de PDF e muito mais.';
const image = `${baseUrl}/og-features.jpg`;
</script>

<template>
    <Head :title="title">
        <meta name="description" :content="description" />
        <meta name="keywords" content="recursos, funcionalidades, checklist, relatório, fotos, PDF" />
        <meta name="robots" content="index, follow" />
        <link rel="canonical" :href="`${baseUrl}/recursos`" />
        <meta property="og:type" content="website" />
        <meta property="og:title" :content="title" />
        <meta property="og:description" :content="description" />
        <meta property="og:url" :content="`${baseUrl}/recursos`" />
        <meta property="og:image" :content="image" />
        <meta name="twitter:card" content="summary_large_image" />
        <meta name="twitter:title" :content="title" />
        <meta name="twitter:description" :content="description" />
        <meta name="twitter:image" :content="image" />
    </Head>

    <PublicLayout>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-24">
            <div class="text-center max-w-3xl mx-auto mb-20">
                <h1 class="text-4xl md:text-5xl font-black text-slate-900 mb-6">Feito para o campo, <span class="text-indigo-600">pensado para o cliente.</span></h1>
                <p class="text-xl text-slate-600">Descubra todas as funcionalidades que vão transformar a forma como você registra suas inspeções e serviços prestados.</p>
            </div>

            <div class="space-y-24">
                <!-- Feature 1 -->
                <div class="flex flex-col md:flex-row items-center gap-12">
                    <div class="flex-1">
                        <div class="w-12 h-12 bg-indigo-100 rounded-xl flex items-center justify-center mb-6 text-indigo-600">
                            <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                            </svg>
                        </div>
                        <h2 class="text-3xl font-bold text-slate-900 mb-4">Construtor de Checklists Flexível</h2>
                        <p class="text-lg text-slate-600 mb-6">
                            Não importa a sua área. Desde manutenção de ar condicionado até inspeção de segurança de EPIs, você pode montar o questionário exatamente como precisa:
                        </p>
                        <ul class="space-y-3 text-slate-600">
                            <li class="flex items-center gap-3">
                                <svg class="w-5 h-5 text-indigo-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>
                                Respostas do tipo Sim/Não
                            </li>
                            <li class="flex items-center gap-3">
                                <svg class="w-5 h-5 text-indigo-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>
                                Textos longos para observações
                            </li>
                            <li class="flex items-center gap-3">
                                <svg class="w-5 h-5 text-indigo-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>
                                Upload de fotos probatórias
                            </li>
                        </ul>
                    </div>
                    <div class="flex-1 w-full relative">
                        <div class="absolute inset-0 bg-gradient-to-tr from-indigo-500 to-violet-500 rounded-2xl rotate-3 scale-105 opacity-20 blur-lg"></div>
                        <div class="bg-white border border-slate-200 rounded-2xl shadow-xl p-6 relative">
                            <div class="space-y-4">
                                <div class="h-8 w-1/3 bg-slate-100 rounded-md"></div>
                                <div class="border border-slate-100 rounded-lg p-4 bg-slate-50">
                                    <div class="h-4 w-2/3 bg-slate-200 rounded mb-3"></div>
                                    <div class="flex gap-2"><div class="h-8 w-16 bg-white border border-slate-200 rounded"></div><div class="h-8 w-16 bg-white border border-slate-200 rounded"></div></div>
                                </div>
                                <div class="border border-slate-100 rounded-lg p-4 bg-slate-50">
                                    <div class="h-4 w-1/2 bg-slate-200 rounded mb-3"></div>
                                    <div class="h-20 w-full bg-white border border-slate-200 rounded"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Feature 2 -->
                <div class="flex flex-col md:flex-row-reverse items-center gap-12">
                    <div class="flex-1">
                        <div class="w-12 h-12 bg-emerald-100 rounded-xl flex items-center justify-center mb-6 text-emerald-600">
                            <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                        </div>
                        <h2 class="text-3xl font-bold text-slate-900 mb-4">Geração de PDF Instantânea</h2>
                        <p class="text-lg text-slate-600 mb-6">
                            Acabou a papelada. Ao finalizar um checklist, você pode exportar um PDF com todas as respostas organizadas e formatadas, além das imagens capturadas durante a inspeção.
                        </p>
                        <p class="text-lg text-slate-600">
                            Você também pode enviar um link público direto para o seu cliente acessar o laudo online.
                        </p>
                    </div>
                    <div class="flex-1 w-full relative">
                        <div class="absolute inset-0 bg-gradient-to-tr from-emerald-400 to-teal-500 rounded-2xl -rotate-3 scale-105 opacity-20 blur-lg"></div>
                        <div class="bg-white border border-slate-200 rounded-2xl shadow-xl p-8 relative flex flex-col items-center justify-center min-h-[300px]">
                            <svg class="w-20 h-20 text-red-500 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
                            </svg>
                            <div class="h-4 w-32 bg-slate-200 rounded mb-2"></div>
                            <div class="h-3 w-24 bg-slate-100 rounded"></div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-24 text-center bg-indigo-50 rounded-3xl p-12 border border-indigo-100">
                <h2 class="text-3xl font-bold text-slate-900 mb-4">Pronto para digitalizar seu serviço?</h2>
                <p class="text-lg text-slate-600 mb-8">Crie sua conta em 30 segundos e experimente grátis.</p>
                <Link :href="route('register')" class="px-8 py-4 text-base font-semibold text-white bg-indigo-600 rounded-full hover:bg-indigo-700 transition-colors">
                    Criar Minha Conta
                </Link>
            </div>
        </div>
    </PublicLayout>
</template>
