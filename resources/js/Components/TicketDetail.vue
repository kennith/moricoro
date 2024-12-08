<script setup lang="ts">
import { watch, watchEffect, ref } from 'vue';

interface Ticket {
    id: number;
    group: string;
    number: string;
}

const props = defineProps<{ ticket: Ticket }>();

watch(
    () => props.ticket,
    (newTicket, oldTicket) => {
        console.log(newTicket.id, oldTicket.id);
    },
);
// watchEffect(async () => {
//     console.log(`${props.ticket.id}`);
// });
</script>

<template>
    <div>{{ ticket.id }}</div>
    <div>{{ ticket.number }}</div>
</template>
