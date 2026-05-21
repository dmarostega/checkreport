<script setup lang="ts">
import { Head } from '@inertiajs/vue3';
import PublicLayout from '@/Layouts/PublicLayout.vue';

const baseUrl = 'https://checkreport.app';
const title = 'Política de Privacidade - CheckLaudo';
const description = 'Conheça a política de privacidade do CheckLaudo. Como protegemos seus dados pessoais e informações de seus relatórios.';
</script>

<template>
    <Head :title="title">
        <meta name="description" :content="description" />
        <meta name="robots" content="index, follow" />
        <link rel="canonical" :href="`${baseUrl}/privacidade`" />
        <meta property="og:type" content="website" />
        <meta property="og:title" :content="title" />
        <meta property="og:description" :content="description" />
        <meta property="og:url" :content="`${baseUrl}/privacidade`" />
    </Head>

    <PublicLayout>
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-24">
            <div class="bg-white rounded-3xl border border-slate-200 p-10 md:p-16 shadow-sm">
                <h1 class="text-3xl md:text-4xl font-black text-slate-900 mb-8">Política de Privacidade</h1>
                
                <div class="prose prose-slate max-w-none">
                    <p class="text-slate-600 mb-6">Última atualização: Janeiro de 2024</p>
                    
                    <h2 class="text-xl font-bold text-slate-900 mt-8 mb-4">Coleta de Dados</h2>
                    <p class="text-slate-600 mb-6">
                        Coletamos o seu nome e e-mail para a criação de conta no CheckLaudo. Os dados dos seus clientes e as informações dos checklists são armazenados exclusivamente para a prestação do serviço contratado (geração de relatórios).
                    </p>

                    <h2 class="text-xl font-bold text-slate-900 mt-8 mb-4">Armazenamento</h2>
                    <p class="text-slate-600 mb-6">
                        As fotos enviadas para os laudos são guardadas de forma segura em nossos servidores e associadas unicamente à sua conta, não sendo indexadas por motores de busca a menos que o link público seja compartilhado por você.
                    </p>

                    <h2 class="text-xl font-bold text-slate-900 mt-8 mb-4">Compartilhamento</h2>
                    <p class="text-slate-600 mb-6">
                        Não vendemos, alugamos ou compartilhamos seus dados pessoais ou os dados dos seus relatórios com terceiros para fins publicitários.
                    </p>
                </div>
            </div>
        </div>
    </PublicLayout>
</template>
