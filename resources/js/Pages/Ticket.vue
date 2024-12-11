<script setup lang="ts">
// This is the shell to display individual ticket.
// The first ticket of the batch should always display
// If there is more than 1 ticket in the batch, it should
// display an navigation button to move from first to the next
// until the end.

import PrimaryButton from '@/Components/PrimaryButton.vue';
import TicketDetail from '@/Components/TicketDetail.vue';
import { computed, ref } from 'vue';

import type { Ticket } from '@/Models/ticket';

const props = defineProps<{
    tickets: Ticket[];
}>();

const hasTicket = computed(() => {
    return props.tickets.length > 0;
});

const currentTicketIndex = ref(0);

const changeTicketIndex = function () {
    if (currentTicketIndex.value < props.tickets.length - 1) {
        currentTicketIndex.value = currentTicketIndex.value + 1;
    } else {
        currentTicketIndex.value = 0;
    }
};

const currentTicket = computed(() => {
    return props.tickets[currentTicketIndex.value];
});

// Echo.channel(`public-channel.${currentTicket.value.group}`).listen(
//     'TicketScannedEvent',
//     (e: any) => {
//         changeTicketIndex();
//     },
// );

Echo.channel(`public-channel.${currentTicket.value.group}`).listen(
    'TicketScannedEvent',
    (e: any) => {
        changeTicketIndex();
    },
);
</script>

<template>
    <div class="flex flex-col items-center justify-between gap-4">
        <div class="my-5 text-2xl">Tickets</div>

        <div class="my-5 text-neutral-500">
            Ticket {{ currentTicketIndex + 1 }} of {{ tickets.length }} tickets in this batch
        </div>

        <PrimaryButton v-on:click="changeTicketIndex" class="my-8">
            Next
        </PrimaryButton>

        <div v-if="hasTicket">
            <TicketDetail :ticket="currentTicket"></TicketDetail>
        </div>

        <div v-else>
            <div>no ticket</div>
        </div>
    </div>
</template>
