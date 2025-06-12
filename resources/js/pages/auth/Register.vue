<script setup lang="ts">
import InputError from '@/components/InputError.vue';
import TextLink from '@/components/TextLink.vue';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import AuthLayout from '@/layouts/AuthLayout.vue';
import axios from 'axios';
import { LoaderCircle } from 'lucide-vue-next';
import { reactive } from 'vue';
import { useRouter } from 'vue-router';

const router = useRouter();

const form = reactive({
    name: '',
    email: '',
    password: '',
    password_confirmation: '',
    errors: {} as Record<string, string[]>,
});

const processing = reactive({
    value: false,
});

const submit = async () => {
    try {
        processing.value = true; // set processing state
        form.errors = {}; // clear previous errors

        await axios.post('/api/auth/register', {
            name: form.name,
            email: form.email,
            password: form.password,
            password_confirmation: form.password_confirmation,
        });

        // reset password fields after submit
        form.password = '';
        form.password_confirmation = '';

        // redirect to login, after registration.
        router.push('/login');
    } catch (error) {
        if (axios.isAxiosError(error) && error.response?.status === 422) {
            // validation errors from Laravel
            form.errors = error.response.data.errors;
        } else {
            console.error(error);
        }
    } finally {
        processing.value = false; // reset processing state
    }
};
</script>

<template>
    <AuthLayout title="Create an account" description="Enter your details below to create your account">
        <form @submit.prevent="submit" class="flex flex-col gap-6">
            <div class="grid gap-6">
                <div class="grid gap-2">
                    <Label for="name">Name</Label>
                    <Input id="name" type="text" autofocus :tabindex="1" autocomplete="name" v-model="form.name" placeholder="Full name" />
                    <InputError v-if="form.errors.name" :message="form.errors.name[0]" />
                </div>

                <div class="grid gap-2">
                    <Label for="email">Email address</Label>
                    <Input id="email" type="email" :tabindex="2" autocomplete="email" v-model="form.email" placeholder="email@example.com" />
                    <InputError v-if="form.errors.email" :message="form.errors.email[0]" />
                </div>

                <div class="grid gap-2">
                    <Label for="password">Password</Label>
                    <Input id="password" type="password" :tabindex="3" autocomplete="new-password" v-model="form.password" placeholder="Password" />
                    <InputError v-if="form.errors.password" :message="form.errors.password[0]" />
                </div>

                <div class="grid gap-2">
                    <Label for="password_confirmation">Confirm password</Label>
                    <Input
                        id="password_confirmation"
                        type="password"
                        :tabindex="4"
                        autocomplete="new-password"
                        v-model="form.password_confirmation"
                        placeholder="Confirm password"
                    />
                    <InputError v-if="form.errors.password_confirmation" :message="form.errors.password_confirmation[0]" />
                </div>

                <Button type="submit" class="mt-2 w-full" tabindex="5" :disabled="processing.value">
                    <LoaderCircle v-if="processing.value" class="h-4 w-4 animate-spin" />
                    Create account
                </Button>
            </div>

            <div class="text-center text-sm text-muted-foreground">
                Already have an account?
                <TextLink to="/login" class="underline underline-offset-4" :tabindex="6">Log in</TextLink>
            </div>
        </form>
    </AuthLayout>
</template>
