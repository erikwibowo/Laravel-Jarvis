<script setup>
import ApplicationLogo from "@/Components/ApplicationLogo.vue";
import {
    ClockIcon,
    Cog6ToothIcon,
    KeyIcon,
    ShieldCheckIcon,
    Squares2X2Icon,
    UserIcon,
} from "@heroicons/vue/24/outline";
import { Link } from "@inertiajs/vue3";
import MenuLabel from "../../Components/MenuLabel.vue";
import NavLink from "../../Components/NavLink.vue";
</script>

<template>
    <div class="text-white">
        <!--        Heder Section-->
        <div
            class="flex justify-center items-center border-b border-white/10 h-16 max-w-full px-3"
        >
            <Link
                :href="route('dashboard')"
                class="flex w-full justify-start items-center space-x-4"
            >
                <ApplicationLogo class="block h-8 w-auto" />
                <p class="block text-lg font-semibold truncate">
                    {{ $page.props.app.setting.name }}
                </p>
            </Link>
        </div>
        <!--        Menus Section-->
        <ol class="pb-24 pt-6 space-y-2">
            <MenuLabel :label-name="lang().label.main_menu" />
            <li
                v-bind:class="
                    route().current('dashboard')
                        ? 'border-l-4 border-white font-semibold bg-white/20 dark:bg-primary/30'
                        : ''
                "
                class="hover:bg-white/20 dark:hover:bg-primary/30"
            >
                <Link
                    :href="route('dashboard')"
                    class="flex items-center py-1.5 px-3 space-x-2"
                >
                    <Squares2X2Icon class="w-5 h-auto" />
                    <span>{{ lang().label.dashboard }}</span>
                </Link>
            </li>
            <MenuLabel
                :label-name="lang().label.access"
                :needs="['user read', 'role read', 'permission read']"
            />
            <NavLink
                :need="['user read']"
                :href="'user.index'"
                :active="'user.index'"
                :link-name="lang().label.user"
            >
                <template #icon>
                    <UserIcon class="w-5 h-auto" />
                </template>
            </NavLink>

            <NavLink
                :need="['role read']"
                :href="'role.index'"
                :active="'role.index'"
                :link-name="lang().label.role"
            >
                <template #icon>
                    <KeyIcon class="w-5 h-auto" />
                </template>
            </NavLink>

            <NavLink
                :need="['permission read']"
                :href="'permission.index'"
                :active="'permission.index'"
                :link-name="lang().label.permission"
            >
                <template #icon>
                    <ShieldCheckIcon class="w-5 h-auto" />
                </template>
            </NavLink>

            <MenuLabel
                :label-name="lang().label.setting"
                :needs="['setting read', 'activity read']"
            />
            <NavLink
                :need="['setting read']"
                :href="'setting.index'"
                :active="'setting.index'"
                :link-name="lang().label.setting"
            >
                <template #icon>
                    <Cog6ToothIcon class="w-5 h-auto" />
                </template>
            </NavLink>

            <NavLink
                :need="['activity read']"
                :href="'activity.index'"
                :active="'activity.index'"
                :link-name="lang().label.activity"
            >
                <template #icon>
                    <ClockIcon class="w-5 h-auto" />
                </template>
            </NavLink>
        </ol>
    </div>
</template>
