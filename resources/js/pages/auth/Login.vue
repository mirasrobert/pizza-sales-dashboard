<script setup lang="ts">
import InputError from '@/components/InputError.vue';
import TextLink from '@/components/TextLink.vue';
import { Button } from '@/components/ui/button';
import { Checkbox } from '@/components/ui/checkbox';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import AuthLayout from '@/layouts/AuthLayout.vue';
import axios from 'axios';
import { LoaderCircle } from 'lucide-vue-next';
import { reactive } from 'vue';
import { useRouter } from 'vue-router';

const router = useRouter();

defineProps<{
    status?: string;
    canResetPassword: boolean;
}>();

const form = reactive({
    email: '',
    password: '',
    remember: false,
    errors: [],
});

const processing = reactive({
    value: false,
});

const submit = async () => {
    try {
        form.errors = []; // clear old errors
        processing.value = true; // set processing state

        await axios.post('/api/auth/login', {
            email: form.email,
            password: form.password,
            remember: form.remember,
        });

        form.password = ''; // reset password field

        // redirect to dashboard after successful login
        router.push('/dashboard');
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
</script>

<template>
    <AuthLayout title="Log in to your account" description="Enter your email and password below to log in">
        <div v-if="status" class="mb-4 text-center text-sm font-medium text-green-600">
            {{ status }}
        </div>

        <form @submit.prevent="submit" class="flex flex-col gap-6">
            <div class="grid gap-6">
                <div class="grid gap-2">
                    <Label for="email">Email address</Label>
                    <Input
                        id="email"
                        type="email"
                        autofocus
                        :tabindex="1"
                        autocomplete="email"
                        v-model="form.email"
                        placeholder="email@example.com"
                    />
                    <InputError v-if="form.errors.email" :message="form.errors.email[0]" />
                </div>

                <div class="grid gap-2">
                    <div class="flex items-center justify-between">
                        <Label for="password">Password</Label>
                        <TextLink v-if="canResetPassword" to="/password_request" class="text-sm" :tabindex="5"> Forgot password? </TextLink>
                    </div>
                    <Input
                        id="password"
                        type="password"
                        :tabindex="2"
                        autocomplete="current-password"
                        v-model="form.password"
                        placeholder="Password"
                    />
                    <InputError v-if="form.errors.password" :message="form.errors.password[0]" />
                </div>

                <div class="flex items-center justify-between">
                    <Label for="remember" class="flex items-center space-x-3">
                        <Checkbox id="remember" v-model="form.remember" :tabindex="3" />
                        <span>Remember me</span>
                    </Label>
                </div>

                <Button type="submit" class="mt-4 w-full" :tabindex="4" :disabled="processing.value">
                    <LoaderCircle v-if="processing.value" class="h-4 w-4 animate-spin" />
                    Log in
                </Button>
            </div>

            <div class="text-center text-sm text-muted-foreground">
                Don't have an account?
                <TextLink to="/register" :tabindex="5">Sign up</TextLink>
            </div>
        </form>
    </AuthLayout>
</template>
