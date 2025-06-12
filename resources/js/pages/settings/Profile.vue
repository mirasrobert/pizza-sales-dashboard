<script setup lang="ts">
import DeleteUser from '@/components/DeleteUser.vue';
import HeadingSmall from '@/components/HeadingSmall.vue';
import InputError from '@/components/InputError.vue';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import AppLayout from '@/layouts/AppLayout.vue';
import SettingsLayout from '@/layouts/settings/Layout.vue';
import { type BreadcrumbItem } from '@/types';
import axios from 'axios';
import { onMounted, reactive } from 'vue';

interface Props {
    status?: string;
}

defineProps<Props>();

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Profile settings',
        href: '/profile',
    },
];

const form = reactive({
    name: '',
    email: '',
    errors: [] as any,
});

const processing = reactive({
    value: false,
    recentlySuccessful: false,
});

const submit = async () => {
    try {
        form.errors = []; // clear old errors
        processing.value = true; // set processing state

        await axios.put('/api/v1/settings/profile', {
            email: form.email,
            name: form.name,
        });

        processing.recentlySuccessful = true; // indicate success

        setTimeout(() => {
            processing.recentlySuccessful = false; // reset success state after a short delay
        }, 2000);
    } catch (error) {
        if (axios.isAxiosError(error) && error.response?.status === 422) {
            form.errors = error.response.data.errors;
        } else {
            console.error(error);
        }
    } finally {
        processing.value = false;
    }
};

// Populate form with user data on mount
onMounted(async () => {
    try {
        const { data } = await axios.get('/api/user');
        form.name = data.name;
        form.email = data.email;
    } catch (error) {
        console.error('Unauthenticated:', error);
    }
});
</script>

<template>
    <AppLayout :breadcrumbs="breadcrumbs">
        <SettingsLayout>
            <div class="flex flex-col space-y-6">
                <HeadingSmall title="Profile information" description="Update your name and email address" />

                <form @submit.prevent="submit" class="space-y-6">
                    <div class="grid gap-2">
                        <Label for="name">Name</Label>
                        <Input id="name" class="mt-1 block w-full" v-model="form.name" required autocomplete="name" placeholder="Full name" />
                        <InputError class="mt-2" v-if="form.errors.name" :message="form.errors.name[0]" />
                    </div>

                    <div class="grid gap-2">
                        <Label for="email">Email address</Label>
                        <Input
                            id="email"
                            type="email"
                            class="mt-1 block w-full"
                            v-model="form.email"
                            required
                            autocomplete="username"
                            placeholder="Email address"
                        />
                        <InputError class="mt-2" v-if="form.errors.email" :message="form.errors.email[0]" />
                    </div>

                    <div class="flex items-center gap-4">
                        <Button :disabled="processing.value">Save</Button>

                        <Transition
                            enter-active-class="transition ease-in-out"
                            enter-from-class="opacity-0"
                            leave-active-class="transition ease-in-out"
                            leave-to-class="opacity-0"
                        >
                            <p v-show="processing.recentlySuccessful" class="text-sm text-neutral-600">Saved.</p>
                        </Transition>
                    </div>
                </form>
            </div>

            <DeleteUser />
        </SettingsLayout>
    </AppLayout>
</template>
