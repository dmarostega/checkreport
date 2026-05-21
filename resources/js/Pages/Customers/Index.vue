<script setup lang="ts">
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link, router } from '@inertiajs/vue3';

defineProps<{
    customers: Array<{
        id: number;
        name: string;
        email: string | null;
        phone: string | null;
        created_at: string;
    }>;
}>();

const deleteCustomer = (id: number) => {
    if (confirm('Tem certeza que deseja excluir este cliente?')) {
        router.delete(route('customers.destroy', id));
    }
};
</script>

<template>
    <Head title="Meus Clientes - CheckLaudo" />

    <AuthenticatedLayout>
        <template #header>
            <div class="flex items-center justify-between">
                <h2 class="text-xl font-semibold leading-tight text-gray-800">
                    Meus Clientes
                </h2>
                <Link :href="route('customers.create')" class="px-4 py-2 bg-indigo-600 text-white text-sm font-medium rounded-lg hover:bg-indigo-700 transition-colors shadow-sm shadow-indigo-500/30">
                    Novo Cliente
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
                                    <th class="p-4 font-medium">Nome</th>
                                    <th class="p-4 font-medium hidden sm:table-cell">E-mail</th>
                                    <th class="p-4 font-medium hidden md:table-cell">Telefone</th>
                                    <th class="p-4 font-medium text-right">Ações</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-100">
                                <tr v-for="customer in customers" :key="customer.id" class="hover:bg-slate-50 transition-colors">
                                    <td class="p-4 font-medium text-slate-900">{{ customer.name }}</td>
                                    <td class="p-4 text-slate-500 hidden sm:table-cell">{{ customer.email || '-' }}</td>
                                    <td class="p-4 text-slate-500 hidden md:table-cell">{{ customer.phone || '-' }}</td>
                                    <td class="p-4 text-right space-x-3">
                                        <Link :href="route('customers.edit', customer.id)" class="text-sm text-indigo-600 hover:text-indigo-900 font-medium">
                                            Editar
                                        </Link>
                                        <button @click="deleteCustomer(customer.id)" class="text-sm text-red-600 hover:text-red-900 font-medium">
                                            Excluir
                                        </button>
                                    </td>
                                </tr>
                                <tr v-if="customers.length === 0">
                                    <td colspan="4" class="p-8 text-center text-slate-500">
                                        Você ainda não possui clientes cadastrados.<br/>
                                        <Link :href="route('customers.create')" class="text-indigo-600 font-medium hover:underline mt-2 inline-block">Cadastrar meu primeiro cliente</Link>
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
