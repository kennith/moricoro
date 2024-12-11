<script setup lang="ts">
import { watch, watchEffect, ref, computed } from 'vue';

import type { Ticket } from '@/Models/ticket';

const props = defineProps<{ ticket: Ticket }>();

const qrCodeUrl = computed(() => {
    return `/qr/${props.ticket.group}/${props.ticket.number}`;
});

const qrCodeResponseUrl = computed(() => {
    return `/activate/qr/${props.ticket.group}/${props.ticket.number}`;
});

watch(
    () => props.ticket,
    (newTicket, oldTicket) => {
        console.log(newTicket.id, oldTicket.id);
    },
);
// watchEffect(async () => {
//     console.log(`${ props.ticket.id } `);
// });
</script>

<template>
    <div class="flex flex-col items-center">
        <div>{{ qrCodeResponseUrl }}</div>
        <div>{{ ticket.number }}</div>
        <div>
            <img :src="qrCodeUrl" />
        </div>
    </div>
</template>
