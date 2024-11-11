<template>
  <div class="flow-root rounded-lg border border-gray-100 py-3 shadow-sm">
    <dl class="-my-3 divide-y divide-gray-100 text-sm">
      <div class="grid grid-cols-1 gap-1 p-3 sm:grid-cols-3 sm:gap-4">
        <dt class="font-medium text-gray-900">Mie Goreng</dt>
        <dd class="text-gray-700 sm:col-span-2">20000</dd>
      </div>
  
      <div class="grid grid-cols-1 gap-1 p-3 sm:grid-cols-3 sm:gap-4">
        <dt class="font-medium text-gray-900">Es Teh Manis</dt>
        <dd class="text-gray-700 sm:col-span-2">8000</dd>
      </div>
  
    </dl>
  </div>

  <div class="py-3">
    <PrimaryButton>Batalkan Pesanan</PrimaryButton>
  </div>
</template>

<script>
import PrimaryButton from '@/Components/PrimaryButton.vue';

export default {
  components: {
    PrimaryButton
  }
}
</script>