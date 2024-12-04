<script setup>
import { router } from "@inertiajs/vue3";
import { pickBy } from "lodash";
import { reactive, watchEffect } from "vue";
import Emptynimation from "@/Animations/empty.json";

const props = defineProps({
    links: Object,
    filters: Object,
});

const data = reactive({
    params: {
        search: props.filters?.search,
        field: props.filters?.field,
        order: props.filters?.order,
        perPage: props.filters?.perPage,
    },
});

const goto = (link) => {
    let params = pickBy(data.params);
    router.get(link, params, {
        replace: true,
        preserveState: true,
        preserveScroll: true,
    });
};

watchEffect(() => {
    data.params.search = props.filters?.search;
    data.params.field = props.filters?.field;
    data.params.order = props.filters?.order;
    data.params.perPage = props.filters?.perPage;
});
</script>
<template>
    <div class="ml-0" v-if="links.data.length != 0">
        {{ num(links.from) }}-{{ num(links.to) }} {{ lang().label.of }}
        {{ num(links.total) }}
    </div>
    <div
        class="flex flex-col space-y-2 mx-auto p-6 text-lg"
        v-if="links.data.length == 0"
    >
        <Vue3Lottie :animationData="Emptynimation" :height="250" :width="250" />
        <p class="text-center">{{ lang().label.no_data }}</p>
    </div>
    <div v-if="links.links.length > 3">
        <ul
            class="hidden lg:flex justify-center items-center rounded overflow-hidden"
        >
            <li>
                <button
                    v-on:click="goto(links.prev_page_url)"
                    class="px-3 py-1.5 hover:bg-primary hover:text-white rounded-tl rounded-bl border-t border-b border-l border-slate-200 dark:border-slate-700 hover:border-primary dark:hover:border-primary"
                    v-html="'&laquo;'"
                    :disabled="links.prev_page_url == null"
                ></button>
            </li>
            <li v-for="(link, index) in links.links" :key="index">
                <button
                    v-if="index != 0 && index + 1 != links.links.length"
                    v-on:click="goto(link.url)"
                    class="px-3 py-1.5 border-y"
                    v-bind:class="
                        link.active
                            ? 'bg-primary text-white border-primary'
                            : 'hover:bg-primary hover:text-white border-slate-200 dark:border-slate-700 hover:border-primary dark:hover:border-primary'
                    "
                    v-html="link.label != '...' ? num(link.label) : link.label"
                    :disabled="link.url == null"
                ></button>
            </li>
            <li>
                <button
                    v-on:click="goto(links.next_page_url)"
                    class="px-3 py-1.5 hover:bg-primary hover:text-white rounded-tr rounded-br border-t border-b border-r border-slate-200 dark:border-slate-700 hover:border-primary dark:hover:border-primary"
                    v-html="'&raquo;'"
                    :disabled="links.next_page_url == null"
                ></button>
            </li>
        </ul>
        <ul
            class="flex lg:hidden justify-center items-center rounded overflow-hidden"
        >
            <li>
                <button
                    v-on:click="goto(links.prev_page_url)"
                    class="px-3 py-1.5 hover:bg-primary hover:text-white rounded-tl rounded-bl border-t border-b border-l border-slate-200 dark:border-slate-700 hover:border-primary dark:hover:border-primary"
                    v-html="'&laquo;'"
                    :disabled="links.prev_page_url == null"
                ></button>
            </li>
            <li>
                <p
                    class="px-3 py-1.5 bg-primary text-white border-y border-primary"
                    v-html="num(links.current_page)"
                ></p>
            </li>
            <li>
                <button
                    v-on:click="goto(links.next_page_url)"
                    class="px-3 py-1.5 hover:bg-primary hover:text-white rounded-tr rounded-br border-t border-b border-r border-slate-200 dark:border-slate-700 hover:border-primary dark:hover:border-primary"
                    v-html="'&raquo;'"
                    :disabled="links.next_page_url == null"
                ></button>
            </li>
        </ul>
    </div>
</template>
