<script setup lang="ts">
import { Separator } from '@/components/ui/separator';
import { type NavItem } from '@/types';

const sidebarNavItems: NavItem[] = [
    {
        title: 'Profile',
        href: '/settings/profile',
    },
];

const currentPath = '/';
</script>

<template>
    <div class="px-4 py-6">
        <div class="flex flex-col space-y-8 pl-5 md:space-y-0 lg:flex-row lg:space-y-0 lg:space-x-12">
            <Separator class="my-6 md:hidden" />

            <div class="flex-1 md:max-w-2xl">
                <section class="max-w-xl space-y-12">
                    <slot />
                </section>
            </div>
        </div>
    </div>
</template>
