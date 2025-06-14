<script setup lang="ts">
import axios from 'axios';
import { reactive, ref } from 'vue';
import { useRouter } from 'vue-router';

// Components
import HeadingSmall from '@/components/HeadingSmall.vue';
import InputError from '@/components/InputError.vue';
import { Button } from '@/components/ui/button';
import {
    Dialog,
    DialogClose,
    DialogContent,
    DialogDescription,
    DialogFooter,
    DialogHeader,
    DialogTitle,
    DialogTrigger,
} from '@/components/ui/dialog';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';

const router = useRouter();
const passwordInput = ref<HTMLInputElement | null>(null);

const processing = reactive({
    value: false,
});

const form = reactive({
    password: '',
    errors: [],
});

const deleteUser = async (e: Event) => {
    e.preventDefault();

    try {
        await axios.delete('/api/v1/settings/profile/delete', {
            data: {
                password: form.password,
            },
        });

        router.push({ name: 'login' });
    } catch (error) {
        if (axios.isAxiosError(error) && error.response?.status === 422) {
            form.errors = error.response.data.errors;
        } else {
            console.error(error);
        }
    }
};

const closeModal = () => {
    form.password = '';
    form.errors = [];
    processing.value = false;
};
</script>

<template>
    <div class="space-y-6">
        <HeadingSmall title="Delete account" description="Delete your account and all of its resources" />
        <div class="space-y-4 rounded-lg border border-red-100 bg-red-50 p-4 dark:border-red-200/10 dark:bg-red-700/10">
            <div class="relative space-y-0.5 text-red-600 dark:text-red-100">
                <p class="font-medium">Warning</p>
                <p class="text-sm">Please proceed with caution, this cannot be undone.</p>
            </div>
            <Dialog>
                <DialogTrigger as-child>
                    <Button variant="destructive">Delete account</Button>
                </DialogTrigger>
                <DialogContent>
                    <form class="space-y-6" @submit="deleteUser">
                        <DialogHeader class="space-y-3">
                            <DialogTitle>Are you sure you want to delete your account?</DialogTitle>
                            <DialogDescription>
                                Once your account is deleted, all of its resources and data will also be permanently deleted. Please enter your
                                password to confirm you would like to permanently delete your account.
                            </DialogDescription>
                        </DialogHeader>

                        <div class="grid gap-2">
                            <Label for="password" class="sr-only">Password</Label>
                            <Input id="password" type="password" name="password" ref="passwordInput" v-model="form.password" placeholder="Password" />
                            <InputError v-if="form.errors.password" :message="form.errors.password[0]" />
                        </div>

                        <DialogFooter class="gap-2">
                            <DialogClose as-child>
                                <Button variant="secondary" @click="closeModal"> Cancel </Button>
                            </DialogClose>

                            <Button type="submit" variant="destructive" :disabled="processing.value"> Delete account </Button>
                        </DialogFooter>
                    </form>
                </DialogContent>
            </Dialog>
        </div>
    </div>
</template>
