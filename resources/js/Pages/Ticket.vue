<script setup lang="ts">
// This is the shell to display individual ticket.
// The first ticket of the batch should always display
// If there is more than 1 ticket in the batch, it should
// display an navigation button to move from first to the next
// until the end.

import PrimaryButton from '@/Components/PrimaryButton.vue';
import TicketDetail from '@/Components/TicketDetail.vue';
import { computed, ref } from 'vue';

const props = defineProps<{
    tickets: {
        id: number;
        group: string;
        number: string;
    }[];
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

Echo.channel(`public-channel.${currentTicket.value.group}`).listen(
    'TicketScannedEvent',
    (e: any) => {
        changeTicketIndex();
    },
);
</script>

<template>
    <div>Tickets</div>
    <div>There are {{ tickets.length }} tickets in this batch</div>
    <PrimaryButton v-on:click="changeTicketIndex">Next</PrimaryButton>

    <div v-if="hasTicket">
        <TicketDetail :ticket="currentTicket"></TicketDetail>
    </div>

    <div v-else>
        <div>no ticket</div>
    </div>
</template>
