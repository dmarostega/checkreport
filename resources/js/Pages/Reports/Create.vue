<script setup lang="ts">
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, useForm, Link } from '@inertiajs/vue3';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';

defineProps<{
    templates: Array<{ id: number; name: string; is_global: boolean }>;
    customers: Array<{ id: number; name: string }>;
}>();

const form = useForm({
    checklist_template_id: '',
    customer_id: '',
});

const submit = () => {
    form.post(route('reports.store'));
};
</script>

<template>
    <Head title="Novo Relatório - CheckLaudo" />

    <AuthenticatedLayout>
        <template #header>
            <div class="flex items-center gap-4">
                <Link :href="route('reports.index')" class="text-slate-400 hover:text-slate-600">
                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" /></svg>
                </Link>
                <h2 class="text-xl font-semibold leading-tight text-gray-800">
                    Iniciar Novo Relatório
                </h2>
            </div>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-2xl sm:px-6 lg:px-8">
                <div class="bg-white shadow-sm sm:rounded-2xl border border-slate-200 overflow-hidden p-8">
                    <form @submit.prevent="submit" class="space-y-6">
                        
                        <!-- Error Global Limit -->
                        <div v-if="$page.props.errors.plan" class="bg-red-50 text-red-800 p-4 rounded-lg border border-red-200 text-sm">
                            {{ $page.props.errors.plan }}
                            <Link :href="route('pricing')" class="block mt-2 text-red-900 font-bold hover:underline">Fazer upgrade de plano</Link>
                        </div>

                        <div>
                            <InputLabel for="template" value="Selecione o Modelo de Checklist *" />
                            <select id="template" v-model="form.checklist_template_id" required class="mt-1 block w-full border-slate-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                                <option disabled value="">Selecione...</option>
                                <option v-for="t in templates" :key="t.id" :value="t.id">
                                    {{ t.name }} {{ t.is_global ? '(Modelo Global)' : '' }}
                                </option>
                            </select>
                            <InputError class="mt-2" :message="form.errors.checklist_template_id" />
                        </div>

                        <div>
                            <InputLabel for="customer" value="Cliente / Local (Opcional)" />
                            <select id="customer" v-model="form.customer_id" class="mt-1 block w-full border-slate-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                                <option value="">Nenhum (Relatório avulso)</option>
                                <option v-for="c in customers" :key="c.id" :value="c.id">
                                    {{ c.name }}
                                </option>
                            </select>
                            <InputError class="mt-2" :message="form.errors.customer_id" />
                        </div>

                        <div class="flex items-center justify-end pt-6 border-t border-slate-100">
                            <Link :href="route('reports.index')" class="text-sm text-slate-500 hover:text-slate-700 font-medium mr-4">
                                Cancelar
                            </Link>
                            <PrimaryButton :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                                Iniciar Preenchimento
                            </PrimaryButton>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
