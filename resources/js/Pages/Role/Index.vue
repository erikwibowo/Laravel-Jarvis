<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import Table from "@/Components/Table.vue";
import Breadcrumb from "@/Layouts/Authenticated/Breadcrumb.vue";
import SelectInput from "@/Components/SelectInput.vue";
import TablePagination from "@/Components/TablePagination.vue";
import TextInput from "@/Components/TextInput.vue";
import Create from "@/Pages/Role/Create.vue";
import Edit from "@/Pages/Role/Edit.vue";
import Delete from "@/Pages/Role/Delete.vue";
import DeleteBulk from "@/Pages/Role/DeleteBulk.vue";
import Permission from "@/Pages/Role/Permission.vue";
import { reactive, watch } from "vue";
import pkg from "lodash";
import { router } from "@inertiajs/vue3";
import { ChevronUpDownIcon } from "@heroicons/vue/24/outline";
import Checkbox from "@/Components/Checkbox.vue";

const { _, debounce, pickBy } = pkg;
const props = defineProps({
    title: String,
    filters: Object,
    roles: Object,
    permissions: Object,
    breadcrumbs: Object,
    perPage: Number,
});

const data = reactive({
    params: {
        search: props.filters.search,
        field: props.filters.field,
        order: props.filters.order,
        perPage: props.perPage,
    },
    selectedId: [],
    multipleSelect: false,
    role: null,
});

const order = (field) => {
    data.params.field = field;
    data.params.order = data.params.order === "asc" ? "desc" : "asc";
};

watch(
    () => _.cloneDeep(data.params),
    debounce(() => {
        let params = pickBy(data.params);
        router.get(route("role.index"), params, {
            replace: true,
            preserveState: true,
            preserveScroll: true,
        });
    }, 150)
);

const selectAll = (event) => {
    if (event.target.checked === false) {
        data.selectedId = [];
    } else {
        props.roles?.data.forEach((role) => {
            data.selectedId.push(role.id);
        });
    }
};
const select = () => {
    if (props.roles?.data.length == data.selectedId.length) {
        data.multipleSelect = true;
    } else {
        data.multipleSelect = false;
    }
};
</script>

<template>
    <AppLayout :title="props.title">
        <template #title>
            <span>{{ props.title }}</span>
        </template>
        <template #breadcrumb>
            <Breadcrumb />
        </template>

        <div class="py-6">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-4">
                <div
                    class="bg-white dark:bg-slate-800 overflow-hidden shadow sm:rounded"
                >
                    <Table>
                        <template #table-action>
                            <div class="flex shrink-0 rounded overflow-hidden">
                                <Create
                                    v-show="can(['role create'])"
                                    :title="props.title"
                                    :permissions="props.permissions"
                                />
                                <DeleteBulk
                                    v-show="
                                        data.selectedId.length != 0 &&
                                        can(['role delete'])
                                    "
                                    :selectedId="data.selectedId"
                                    :title="props.title"
                                    @close="
                                        (data.selectedId = []),
                                            (data.multipleSelect = false)
                                    "
                                />
                            </div>
                            <div class="flex justify-end items-center gap-2">
                                <div class="flex space-x-2">
                                    <SelectInput
                                        class="h-9 text-sm"
                                        v-model="data.params.perPage"
                                        :dataSet="$page.props.app.perpage"
                                    />
                                </div>
                                <TextInput
                                    v-model="data.params.search"
                                    type="search"
                                    class="block h-9"
                                    :placeholder="lang().placeholder.search"
                                />
                            </div>
                        </template>
                        <template #table-head>
                            <tr>
                                <th class="p-4 text-left">
                                    <Checkbox
                                        v-model:checked="data.multipleSelect"
                                        @change="selectAll"
                                    />
                                </th>
                                <th class="p-4 text-center">#</th>
                                <th
                                    class="p-4 cursor-pointer"
                                    v-on:click="order('name')"
                                >
                                    <div
                                        class="flex justify-between items-center"
                                    >
                                        <span>{{ lang().label.name }}</span>
                                        <ChevronUpDownIcon class="w-4 h-4" />
                                    </div>
                                </th>
                                <th
                                    class="p-4 cursor-pointer"
                                    v-on:click="order('guard_name')"
                                >
                                    <div
                                        class="flex justify-between items-center"
                                    >
                                        <span>Guard</span>
                                        <ChevronUpDownIcon class="w-4 h-4" />
                                    </div>
                                </th>
                                <th class="p-4t text-left">
                                    {{ lang().label.permission }}
                                </th>
                                <th
                                    class="p-4 cursor-pointer"
                                    v-on:click="order('created_at')"
                                >
                                    <div
                                        class="flex justify-between items-center"
                                    >
                                        <span>{{ lang().label.created }}</span>
                                        <ChevronUpDownIcon class="w-4 h-4" />
                                    </div>
                                </th>
                                <th class="p-4 text-center sr-only">Action</th>
                            </tr>
                        </template>
                        <template #table-body>
                            <tr
                                v-for="(role, index) in roles.data"
                                :key="index"
                                class="border-t border-slate-200 dark:border-slate-700 hover:bg-slate-200/30 hover:dark:bg-slate-900/20"
                            >
                                <td class="whitespace-nowrap px-4 py-2">
                                    <input
                                        class="rounded dark:bg-slate-900 border-slate-300 dark:border-slate-700 text-primary dark:text-primary shadow-sm focus:ring-primary/80 dark:focus:ring-primary dark:focus:ring-offset-slate-800 dark:checked:bg-primary dark:checked:border-primary"
                                        type="checkbox"
                                        @change="select"
                                        :value="role.id"
                                        v-model="data.selectedId"
                                    />
                                </td>
                                <td
                                    class="whitespace-nowrap px-4 py-2 sm:py-3 text-center"
                                >
                                    {{ ++index }}
                                </td>
                                <td class="whitespace-nowrap px-4 py-2">
                                    {{ role.name }}
                                </td>
                                <td class="whitespace-nowrap px-4 py-2">
                                    {{ role.guard_name }}
                                </td>
                                <td class="whitespace-nowrap px-4 py-2">
                                    <div v-if="role.permissions.length != 0">
                                        <Permission
                                            v-if="
                                                role.permissions.length ==
                                                props.permissions.reduce(
                                                    (total, data) =>
                                                        total +
                                                        data.data.length,
                                                    0
                                                )
                                            "
                                            :permissions="role.permissions"
                                            :title="lang().label.all_permission"
                                            :caption="role.name"
                                        />
                                        <Permission
                                            v-else
                                            :permissions="role.permissions"
                                            :title="
                                                role.permissions.length +
                                                ' Permissions'
                                            "
                                            :caption="role.name"
                                        />
                                    </div>
                                    <p v-else>
                                        {{ lang().label.no_permission }}
                                    </p>
                                </td>
                                <td class="whitespace-nowrap px-4 py-2">
                                    {{ role.created_at }}
                                </td>
                                <td
                                    class="whitespace-nowrap flex justify-end px-4 py-2 sm:py-3"
                                >
                                    <div
                                        class="flex w-fit rounded overflow-hidden"
                                    >
                                        <Edit
                                            v-show="can(['role update'])"
                                            :title="props.title"
                                            :role="data.role"
                                            @open="data.role = role"
                                            :permissions="props.permissions"
                                        />
                                        <Delete
                                            v-show="can(['role delete'])"
                                            :title="props.title"
                                            :role="data.role"
                                            @open="data.role = role"
                                        />
                                    </div>
                                </td>
                            </tr>
                        </template>
                        <template #table-pagination>
                            <TablePagination
                                :links="props.roles"
                                :filters="data.params"
                            />
                        </template>
                    </Table>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
