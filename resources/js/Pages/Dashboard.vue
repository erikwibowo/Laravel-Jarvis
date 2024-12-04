<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import Breadcrumb from "@/Layouts/Authenticated/Breadcrumb.vue";
import { KeyIcon, ShieldCheckIcon, UserIcon } from "@heroicons/vue/24/outline";

const props = defineProps({
    userCount: Number,
    roleCount: Number,
    permissionCount: Number,
});
</script>

<template>
    <AppLayout :title="lang().label.dashboard">
        <template #title>
            <span>{{ lang().label.dashboard }}</span>
        </template>
        <template #breadcrumb>
            <Breadcrumb />
        </template>

        <div class="py-6">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div
                    class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4"
                >
                    <div
                        class="bg-white dark:bg-slate-800 overflow-hidden shadow sm:rounded text-slate-800 dark:text-slate-200 flex gap-4"
                    >
                        <div
                            class="w-24 h-24 bg-sky-500 flex m-2 rounded justify-center items-center"
                        >
                            <UserIcon class="w-12 h-auto text-white" />
                        </div>
                        <div class="flex flex-col justify-center items-start">
                            <p class="truncate font-semibold max-w-full">
                                {{ lang().label.user }}
                            </p>
                            <p class="text-3xl font-semibold text-primary">
                                {{ num(props.userCount) }}
                            </p>
                        </div>
                    </div>
                    <div
                        class="bg-white dark:bg-slate-800 overflow-hidden shadow sm:rounded text-slate-800 dark:text-slate-200 flex gap-4"
                    >
                        <div
                            class="w-24 h-24 bg-emerald-500 flex m-2 rounded justify-center items-center"
                        >
                            <KeyIcon class="w-12 h-auto text-white" />
                        </div>
                        <div class="flex flex-col justify-center items-start">
                            <p class="truncate font-semibold max-w-full">
                                {{ lang().label.role }}
                            </p>
                            <p class="text-3xl font-semibold text-primary">
                                {{ num(props.roleCount) }}
                            </p>
                        </div>
                    </div>
                    <div
                        class="bg-white dark:bg-slate-800 overflow-hidden shadow sm:rounded text-slate-800 dark:text-slate-200 flex gap-4"
                    >
                        <div
                            class="w-24 h-24 bg-amber-500 flex m-2 rounded justify-center items-center"
                        >
                            <ShieldCheckIcon class="w-12 h-auto text-white" />
                        </div>
                        <div class="flex flex-col justify-center items-start">
                            <p class="truncate font-semibold max-w-full">
                                {{ lang().label.permission }}
                            </p>
                            <p class="text-3xl font-semibold text-primary">
                                {{ num(props.permissionCount) }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
