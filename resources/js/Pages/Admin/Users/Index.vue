<script setup lang="ts">
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, useForm } from '@inertiajs/vue3';
import { ref } from 'vue';

const props = defineProps<{
    users: {
        data: Array<{
            id: number;
            name: string;
            email: string;
            role: string;
            created_at: string;
            active_plan: { id: number; name: string } | null;
        }>;
        links: any[];
    };
    plans: Array<{
        id: number;
        name: string;
    }>;
}>();

const editingUser = ref<any>(null);

const form = useForm({
    role: '',
    plan_id: '',
});

const openEditModal = (user: any) => {
    editingUser.value = user;
    form.role = user.role;
    form.plan_id = user.active_plan?.id || (props.plans.length > 0 ? props.plans[0].id : '');
};

const closeEditModal = () => {
    editingUser.value = null;
    form.reset();
};

const submitEdit = () => {
    if (!editingUser.value) return;
    form.put(route('admin.users.update', editingUser.value.id), {
        onSuccess: () => closeEditModal(),
    });
};

const formatDate = (dateString: string) => {
    return new Date(dateString).toLocaleDateString('pt-BR');
};
</script>

<template>
    <Head title="Gerenciar Usuários - Admin" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                Usuários Cadastrados
            </h2>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="bg-white shadow-sm sm:rounded-2xl border border-slate-200 overflow-hidden">
                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr class="bg-slate-50 border-b border-slate-200 text-slate-500 text-sm">
                                    <th class="p-4 font-medium">Usuário</th>
                                    <th class="p-4 font-medium">Papel</th>
                                    <th class="p-4 font-medium">Plano Atual</th>
                                    <th class="p-4 font-medium">Cadastro</th>
                                    <th class="p-4 font-medium text-right">Ações</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-100">
                                <tr v-for="user in users.data" :key="user.id" class="hover:bg-slate-50 transition-colors">
                                    <td class="p-4">
                                        <p class="font-medium text-slate-900">{{ user.name }}</p>
                                        <p class="text-sm text-slate-500">{{ user.email }}</p>
                                    </td>
                                    <td class="p-4">
                                        <span v-if="user.role === 'admin'" class="px-2.5 py-1 text-xs font-medium bg-red-100 text-red-800 rounded-full">Admin</span>
                                        <span v-else class="px-2.5 py-1 text-xs font-medium bg-slate-100 text-slate-800 rounded-full">User</span>
                                    </td>
                                    <td class="p-4 font-medium text-indigo-600">
                                        {{ user.active_plan ? user.active_plan.name : 'Nenhum' }}
                                    </td>
                                    <td class="p-4 text-slate-600">{{ formatDate(user.created_at) }}</td>
                                    <td class="p-4 text-right">
                                        <button @click="openEditModal(user)" class="text-sm text-indigo-600 hover:text-indigo-900 font-medium">
                                            Modificar Acesso
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal Edit -->
        <div v-if="editingUser" class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-slate-900/50 backdrop-blur-sm">
            <div class="bg-white rounded-2xl shadow-xl max-w-md w-full p-6">
                <h3 class="text-lg font-bold text-slate-900 mb-4">Modificar Usuário: {{ editingUser.name }}</h3>
                
                <form @submit.prevent="submitEdit" class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1">Papel do Usuário (Role)</label>
                        <select v-model="form.role" class="w-full border-slate-300 rounded-lg shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            <option value="user">Usuário Comum</option>
                            <option value="admin">Administrador Geral</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1">Forçar Alteração de Plano</label>
                        <select v-model="form.plan_id" class="w-full border-slate-300 rounded-lg shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            <option v-for="plan in plans" :key="plan.id" :value="plan.id">{{ plan.name }}</option>
                        </select>
                        <p class="text-xs text-slate-500 mt-1">Isso alterará os limites da conta imediatamente.</p>
                    </div>

                    <div class="flex gap-3 justify-end mt-8">
                        <button type="button" @click="closeEditModal" class="px-4 py-2 text-sm font-medium text-slate-600 hover:bg-slate-50 rounded-lg">Cancelar</button>
                        <button type="submit" :disabled="form.processing" class="px-4 py-2 text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 rounded-lg disabled:opacity-50">
                            Salvar Alterações
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
