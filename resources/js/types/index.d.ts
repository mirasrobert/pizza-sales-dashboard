import type { LucideIcon } from 'lucide-vue-next';
import type { Config } from 'ziggy-js';

export interface Auth {
    user: User;
}

export interface BreadcrumbItem {
    title: string;
    href: string;
}

export interface NavItem {
    title: string;
    href: string;
    icon?: LucideIcon;
    isActive?: boolean;
}

export type AppPageProps<T extends Record<string, unknown> = Record<string, unknown>> = T & {
    name: string;
    quote: { message: string; author: string };
    auth: Auth;
    ziggy: Config & { location: string };
    sidebarOpen: boolean;
};

export interface User {
    id: number;
    name: string;
    email: string;
    avatar?: string;
    email_verified_at: string | null;
    created_at: string;
    updated_at: string;
}

export interface SaleSummary {
    total_revenue: string;
    total_orders: number;
    total_pizzas_sold: string;
    average_order_per_month: string;
}

interface Pizza {
    id: string;
    pizza_type_id: string;
    size: string;
    price: string;
}

export interface TopPizza {
    pizza_id: string;
    total_quantity: string;
    pizza: Pizza
  }


export type BreadcrumbItemType = BreadcrumbItem;
