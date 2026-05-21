<script setup lang="ts">
import { Head } from '@inertiajs/vue3';
import PublicLayout from '@/Layouts/PublicLayout.vue';

const baseUrl = 'https://checkreport.app';
const title = 'Termos de Uso - CheckLaudo';
const description = 'Leia os termos de uso do CheckLaudo. Informações sobre responsabilidade técnica e limitações de uso do serviço.';
</script>

<template>
    <Head :title="title">
        <meta name="description" :content="description" />
        <meta name="robots" content="index, follow" />
        <link rel="canonical" :href="`${baseUrl}/termos`" />
        <meta property="og:type" content="website" />
        <meta property="og:title" :content="title" />
        <meta property="og:description" :content="description" />
        <meta property="og:url" :content="`${baseUrl}/termos`" />
    </Head>

    <PublicLayout>
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-24">
            <div class="bg-white rounded-3xl border border-slate-200 p-10 md:p-16 shadow-sm">
                <h1 class="text-3xl md:text-4xl font-black text-slate-900 mb-8">Termos de Uso</h1>
                
                <div class="prose prose-slate max-w-none">
                    <p class="text-slate-600 mb-6">Última atualização: Janeiro de 2024</p>
                    
                    <h2 class="text-xl font-bold text-slate-900 mt-8 mb-4">1. Visão Geral</h2>
                    <p class="text-slate-600 mb-6">
                        O CheckLaudo é uma ferramenta de software como serviço (SaaS) destinada a auxiliar profissionais e prestadores de serviços na criação, preenchimento e organização de checklists e vistorias simples.
                    </p>
                    
                    <div class="bg-red-50 border-l-4 border-red-500 p-4 mb-8">
                        <h3 class="text-lg font-bold text-red-800 mb-2">2. Aviso Legal de Responsabilidade Técnica</h3>
                        <p class="text-red-700">
                            <strong>O sistema não possui validade jurídica intrínseca, não emite ART (Anotação de Responsabilidade Técnica), não configura laudo de engenharia regulamentado ou laudo médico.</strong> O CheckLaudo atua exclusivamente como um organizador de informações. Toda a responsabilidade técnica, civil e criminal pelas informações inseridas e pelos relatórios gerados recai unicamente sobre o usuário (profissional) que utiliza a ferramenta.
                        </p>
                    </div>

                    <h2 class="text-xl font-bold text-slate-900 mt-8 mb-4">3. Limitações do Plano Gratuito</h2>
                    <p class="text-slate-600 mb-6">
                        O plano gratuito é oferecido "no estado em que se encontra", sujeito aos limites estabelecidos na página de preços (ex: limite de relatórios e templates). O CheckLaudo reserva-se o direito de alterar esses limites mediante aviso prévio.
                    </p>

                    <h2 class="text-xl font-bold text-slate-900 mt-8 mb-4">4. Dados e Privacidade</h2>
                    <p class="text-slate-600 mb-6">
                        Os dados inseridos nos relatórios (textos e fotos) são armazenados de forma segura, mas recomendamos que o usuário mantenha backups locais das suas informações. Não vendemos dados de checklists para terceiros.
                    </p>
                </div>
            </div>
        </div>
    </PublicLayout>
</template>
