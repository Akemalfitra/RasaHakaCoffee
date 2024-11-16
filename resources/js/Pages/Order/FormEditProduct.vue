<template>

  <section class="bg-gray-100">
    <div class="mx-auto max-w-screen-xl px-4 py-16 sm:px-6 lg:px-8">
      <div class="grid grid-cols-1 gap-x-16 gap-y-8 lg:grid-cols-5">
        <div class="lg:col-span-2 lg:py-12">
          <p class="max-w-xl text-lg">
            Edit menu.
          </p>
  
          <div class="mt-8">
            <a href="#" class="text-2xl font-bold text-yellow-600"> RM Simangat </a>
  
            <address class="mt-2 not-italic">Lhokseumawe, Hagu Barat Laut.</address>
          </div>
        </div>
  
        <div class="rounded-lg bg-white p-8 shadow-lg lg:col-span-3 lg:p-12">
          <form action="#" class="space-y-4">
            <div>
              <label class="sr-only" for="name">Nama menu</label>
              <input
                class="w-full rounded-lg border-gray-200 p-3 text-sm"
                placeholder="Nama menu"
                type="text"
                name= "name"
                :value="data[0].nama"  
              />
            </div>
  
            <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
              <div>
                <label class="sr-only" for="jenis">Jenis</label>
                <input
                  class="w-full rounded-lg border-gray-200 p-3 text-sm"
                  placeholder="Jenis"
                  type="text"
                  name="jenis"
                  :value="data[0].jenis"
                />
              </div>
  
              <div>
                <label class="sr-only" for="harga">Harga</label>
                <input
                  class="w-full rounded-lg border-gray-200 p-3 text-sm"
                  placeholder="harga"
                  type="number"
                  name="harga"
                  :value="data[0].harga"
                />
              </div>
            </div>
  
            <div>
              <label class="sr-only" for="foto">Foto</label>
              <p class="py-3">Update foto menu <span class="text-gray-400">(kosongkan bila tidak ada perubahan).</span></p>
  
             <input
                  class="w-full rounded-lg border-gray-200 p-3 text-sm"
                  placeholder="foto"
                  type="file"
                  name="foto"
                />
            </div>
  
            <div class="mt-4">
              <button
                type="submit"
                class="inline-block w-full rounded-lg bg-black px-5 py-3 font-medium text-white sm:w-auto"
              >
                Ubah data
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </section>
</template>

<script>
export default {
    props: {
        data: {
            required: true
        }
    }
}

</script>