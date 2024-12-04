<script setup>
import { ref } from "vue";
import { Link, router } from "@inertiajs/vue3";
import ApplicationLogo from "@/Components/ApplicationLogo.vue";
import Dropdown from "@/Components/Dropdown.vue";
import DropdownLink from "@/Components/DropdownLink.vue";
import SwitchDarkMode from "@/Components/SwitchDarkMode.vue";
import { Bars3BottomLeftIcon, GlobeAltIcon } from "@heroicons/vue/24/outline";
import SwitchLocale from "@/Components/SwitchLocale.vue";
import { CheckBadgeIcon } from "@heroicons/vue/24/solid";

const emit = defineEmits(["open"]);
const switchToTeam = (team) => {
    router.put(
        route("current-team.update"),
        {
            team_id: team.id,
        },
        {
            preserveState: false,
        }
    );
};

const logout = () => {
    router.post(route("logout"));
};
</script>
<template>
    <nav
        class="bg-white fixed w-full md:pr-64 dark:bg-slate-800 border-b border-slate-100 dark:border-slate-700"
    >
        <!-- Primary Navigation Menu -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex">
                    <!-- Logo -->
                    <div class="shrink-0 flex items-center">
                        <button
                            @click="emit('open')"
                            class="inline-flex md:hidden items-center justify-center p-2 rounded text-slate-400 dark:text-slate-500 hover:text-slate-500 dark:hover:text-slate-400 hover:bg-slate-100 dark:hover:bg-slate-900 focus:outline-none focus:bg-slate-100 dark:focus:bg-slate-900 focus:text-slate-500 dark:focus:text-slate-400 transition duration-150 ease-in-out mr-4"
                        >
                            <Bars3BottomLeftIcon class="w-6 h-auto" />
                        </button>
                        <p
                            class="flex space-x-2 text-lg font-semibold text-slate-600 dark:text-white max-w-fit truncate"
                        >
                            <slot />
                        </p>
                    </div>
                </div>

                <div class="flex items-center space-x-1">
                    <SwitchLocale />
                    <a
                        target="_blank"
                        v-tooltip="lang().label.go_to_webiste"
                        :href="route('index')"
                        class="inline-flex items-center justify-center p-2 rounded text-slate-400 dark:text-slate-500 hover:text-slate-500 dark:hover:text-slate-400 hover:bg-slate-100 dark:hover:bg-slate-900 focus:outline-none focus:bg-slate-100 dark:focus:bg-slate-900 focus:text-slate-500 dark:focus:text-slate-400 transition duration-150 ease-in-out mr-4"
                    >
                        <GlobeAltIcon class="w-6 h-auto" />
                    </a>
                    <SwitchDarkMode />
                    <div class="relative">
                        <!-- Teams Dropdown -->
                        <Dropdown
                            v-if="$page.props.jetstream.hasTeamFeatures"
                            align="right"
                            width="60"
                        >
                            <template #trigger>
                                <span class="inline-flex rounded">
                                    <button
                                        type="button"
                                        class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded text-slate-500 dark:text-slate-400 bg-white dark:bg-slate-800 hover:text-slate-700 dark:hover:text-slate-300 focus:outline-none focus:bg-slate-50 dark:focus:bg-slate-700 active:bg-slate-50 dark:active:bg-slate-700 transition ease-in-out duration-150"
                                    >
                                        {{
                                            $page.props.auth.user.current_team
                                                .name
                                        }}

                                        <svg
                                            class="ml-2 -mr-0.5 h-4 w-4"
                                            xmlns="http://www.w3.org/2000/svg"
                                            fill="none"
                                            viewBox="0 0 24 24"
                                            stroke-width="1.5"
                                            stroke="currentColor"
                                        >
                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                d="M8.25 15L12 18.75 15.75 15m-7.5-6L12 5.25 15.75 9"
                                            />
                                        </svg>
                                    </button>
                                </span>
                            </template>

                            <template #content>
                                <div class="w-60">
                                    <!-- Team Management -->
                                    <template
                                        v-if="
                                            $page.props.jetstream
                                                .hasTeamFeatures
                                        "
                                    >
                                        <div
                                            class="block px-4 py-2 text-xs text-slate-400"
                                        >
                                            {{ lang().label.manage_team }}
                                        </div>

                                        <!-- Team Settings -->
                                        <DropdownLink
                                            :href="
                                                route(
                                                    'teams.show',
                                                    $page.props.auth.user
                                                        .current_team
                                                )
                                            "
                                        >
                                            {{ lang().label.team_settings }}
                                        </DropdownLink>

                                        <DropdownLink
                                            v-if="
                                                $page.props.jetstream
                                                    .canCreateTeams
                                            "
                                            :href="route('teams.create')"
                                        >
                                            {{ lang().label.create_new_team }}
                                        </DropdownLink>

                                        <div
                                            class="border-t border-slate-200 dark:border-slate-600"
                                        />

                                        <!-- Team Switcher -->
                                        <div
                                            class="block px-4 py-2 text-xs text-slate-400"
                                        >
                                            {{ lang().label.switch_teams }}
                                        </div>

                                        <template
                                            v-for="team in $page.props.auth.user
                                                .all_teams"
                                            :key="team.id"
                                        >
                                            <form
                                                @submit.prevent="
                                                    switchToTeam(team)
                                                "
                                            >
                                                <DropdownLink as="button">
                                                    <div
                                                        class="flex items-center"
                                                    >
                                                        <svg
                                                            v-if="
                                                                team.id ==
                                                                $page.props.auth
                                                                    .user
                                                                    .current_team_id
                                                            "
                                                            class="mr-2 h-5 w-5 text-green-400"
                                                            xmlns="http://www.w3.org/2000/svg"
                                                            fill="none"
                                                            viewBox="0 0 24 24"
                                                            stroke-width="1.5"
                                                            stroke="currentColor"
                                                        >
                                                            <path
                                                                stroke-linecap="round"
                                                                stroke-linejoin="round"
                                                                d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z"
                                                            />
                                                        </svg>

                                                        <div>
                                                            {{ team.name }}
                                                        </div>
                                                    </div>
                                                </DropdownLink>
                                            </form>
                                        </template>
                                    </template>
                                </div>
                            </template>
                        </Dropdown>
                    </div>

                    <!-- Settings Dropdown -->
                    <div class="relative">
                        <Dropdown align="right" width="48">
                            <template #trigger>
                                <button
                                    v-if="
                                        $page.props.jetstream
                                            .managesProfilePhotos
                                    "
                                    class="flex text-sm border-2 border-transparent rounded focus:outline-none focus:border-slate-300 transition"
                                >
                                    <img
                                        class="h-8 w-8 rounded object-cover"
                                        :src="
                                            $page.props.auth.user
                                                .profile_photo_url
                                        "
                                        :alt="$page.props.auth.user.name"
                                    />
                                </button>

                                <span v-else class="inline-flex rounded">
                                    <button
                                        type="button"
                                        class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded text-slate-500 dark:text-slate-400 bg-white dark:bg-slate-800 hover:text-slate-700 dark:hover:text-slate-300 focus:outline-none focus:bg-slate-50 dark:focus:bg-slate-700 active:bg-slate-50 dark:active:bg-slate-700 transition ease-in-out duration-150"
                                    >
                                        {{ $page.props.auth.user.name }}

                                        <svg
                                            class="ml-2 -mr-0.5 h-4 w-4"
                                            xmlns="http://www.w3.org/2000/svg"
                                            fill="none"
                                            viewBox="0 0 24 24"
                                            stroke-width="1.5"
                                            stroke="currentColor"
                                        >
                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                d="M19.5 8.25l-7.5 7.5-7.5-7.5"
                                            />
                                        </svg>
                                    </button>
                                </span>
                            </template>

                            <template #content>
                                <!-- Account Management -->
                                <div
                                    class="block px-4 py-2 truncate border-b border-slate-200 dark:border-slate-600"
                                >
                                    <div class="flex items-center">
                                        <p>
                                            {{ $page.props.auth.user.name }}
                                        </p>
                                        <CheckBadgeIcon
                                            v-if="
                                                $page.props.auth.user
                                                    .email_verified_at
                                            "
                                            class="w-4 h-auto text-blue-500 ml-1 shrink-0"
                                        />
                                    </div>
                                    <div class="block text-xs truncate">
                                        {{ $page.props.auth.user.email }}
                                    </div>
                                </div>
                                <div
                                    class="block px-4 py-2 text-xs text-slate-400"
                                >
                                    {{ lang().label.manage_account }}
                                </div>

                                <DropdownLink :href="route('profile.show')">
                                    {{ lang().label.profile }}
                                </DropdownLink>

                                <DropdownLink
                                    v-show="can(['setting read'])"
                                    :href="route('setting.index')"
                                >
                                    {{ lang().label.setting }}
                                </DropdownLink>

                                <DropdownLink
                                    v-if="$page.props.jetstream.hasApiFeatures"
                                    :href="route('api-tokens.index')"
                                >
                                    {{ lang().label.api_tokens }}
                                </DropdownLink>

                                <div
                                    class="border-t border-slate-200 dark:border-slate-600"
                                />

                                <!-- Authentication -->
                                <form @submit.prevent="logout">
                                    <DropdownLink as="button">
                                        {{ lang().label.logout }}
                                    </DropdownLink>
                                </form>
                            </template>
                        </Dropdown>
                    </div>
                </div>
            </div>
        </div>
    </nav>
</template>
