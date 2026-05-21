<script setup lang="ts">
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, useForm, Link } from '@inertiajs/vue3';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';

const props = defineProps<{
    plan: {
        id: number;
        name: string;
        tier: string;
        stripe_price_id: string | null;
        price_monthly: number;
        max_templates: number;
        max_reports_per_month: number;
    }
}>();

const form = useForm({
    name: props.plan.name,
    tier: props.plan.tier,
    stripe_price_id: props.plan.stripe_price_id || '',
    price_monthly: props.plan.price_monthly,
    max_templates: props.plan.max_templates,
    max_reports_per_month: props.plan.max_reports_per_month,
});

const submit = () => {
    form.put(route('admin.plans.update', props.plan.id));
};
</script>

<template>
    <Head :title="`Editar Plano: ${plan.name} - Admin`" />

    <AuthenticatedLayout>
        <template #header>
            <div class="flex items-center gap-4">
                <Link :href="route('admin.plans.index')" class="text-slate-400 hover:text-slate-600">
                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" /></svg>
                </Link>
                <h2 class="text-xl font-semibold leading-tight text-gray-800">
                    Editar Plano: {{ plan.name }}
                </h2>
            </div>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-3xl sm:px-6 lg:px-8">
                <div class="bg-white shadow-sm sm:rounded-2xl border border-slate-200 overflow-hidden p-8">
                    <form @submit.prevent="submit" class="space-y-6">
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <InputLabel for="name" value="Nome do Plano" />
                                <TextInput id="name" type="text" class="mt-1 block w-full" v-model="form.name" required />
                                <InputError class="mt-2" :message="form.errors.name" />
                            </div>

                            <div>
                                <InputLabel for="tier" value="Nível (Tier Interno)" />
                                <select id="tier" v-model="form.tier" class="mt-1 block w-full border-slate-300 rounded-md shadow-sm">
                                    <option value="free">Gratuito (free)</option>
                                    <option value="pro">Profissional (pro)</option>
                                    <option value="plus">Premium (plus)</option>
                                    <option value="enterprise">Empresarial (enterprise)</option>
                                </select>
                                <InputError class="mt-2" :message="form.errors.tier" />
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <InputLabel for="price_monthly" value="Preço Mensal (R$)" />
                                <TextInput id="price_monthly" type="number" step="0.01" class="mt-1 block w-full" v-model="form.price_monthly" required />
                                <InputError class="mt-2" :message="form.errors.price_monthly" />
                            </div>

                            <div>
                                <InputLabel for="stripe_price_id" value="ID do Preço no Stripe (Opcional)" />
                                <TextInput id="stripe_price_id" type="text" class="mt-1 block w-full" v-model="form.stripe_price_id" />
                                <InputError class="mt-2" :message="form.errors.stripe_price_id" />
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <InputLabel for="max_templates" value="Máximo de Modelos (-1 = Ilimitado)" />
                                <TextInput id="max_templates" type="number" class="mt-1 block w-full" v-model="form.max_templates" required />
                                <InputError class="mt-2" :message="form.errors.max_templates" />
                            </div>

                            <div>
                                <InputLabel for="max_reports_per_month" value="Máx Relatórios/Mês (-1 = Ilimitado)" />
                                <TextInput id="max_reports_per_month" type="number" class="mt-1 block w-full" v-model="form.max_reports_per_month" required />
                                <InputError class="mt-2" :message="form.errors.max_reports_per_month" />
                            </div>
                        </div>

                        <div class="flex items-center justify-end pt-6 border-t border-slate-100">
                            <Link :href="route('admin.plans.index')" class="text-sm text-slate-500 hover:text-slate-700 font-medium mr-4">
                                Cancelar
                            </Link>
                            <PrimaryButton :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                                Salvar Alterações
                            </PrimaryButton>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
