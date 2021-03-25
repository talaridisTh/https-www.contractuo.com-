<template>
  <section class=" mx-auto container max-w-2xl md:w-3/4 ">

    <form @submit.prevent="updateUser" class="space-y-6">
      <div>
        <ul v-for="(error, key) in errors" :key="key">
          <li class="text-xs text-red-500" v-text="error[0]"></li>
        </ul>
      </div>
      <span class="text-green-600 text-lg font-semibold" v-show="notify" v-text="notify"></span>
      <div class="md:inline-flex space-y-4 md:space-y-0 w-full p-4 text-gray-500 items-center">
        <h2 class="md:w-1/3 max-w-sm mx-auto">Account</h2>
        <div class="md:w-2/3 max-w-sm mx-auto">
          <label for="email" class="text-sm text-gray-400">Email</label>
          <input v-model="user.email"
                 :class="{'border border-red-500' : errors.email}"
                 @keydown="errors.email=''"
                 id="email"
                 type="email"
                 class="w-11/12 focus:outline-none rounded focus:text-gray-600 p-2"
                 placeholder="email@example.com" />
        </div>
      </div>
      <hr />
      <div class="md:inline-flex  space-y-4 md:space-y-0  w-full p-4 text-gray-500 items-center">
        <h2 class="md:w-1/3 mx-auto max-w-sm">Personal info</h2>
        <div class="md:w-2/3 mx-auto max-w-sm space-y-5">
          <div class="w-full">
            <label for="name" class="text-sm text-gray-400">Full name</label>
            <input v-model="user.name"
                   :class="{'border border-red-500' : errors.name}"
                   @keydown="errors.name=''"
                   type="text"
                   id="name"
                   class="w-11/12 focus:outline-none  rounded focus:text-gray-600 p-2"
                   placeholder="Charly Olivas" />
          </div>
        </div>
      </div>
      <hr />
      <div class="md:inline-flex w-full space-y-4 md:space-y-0 p-8 text-gray-500 items-center">
        <h2 class="md:w-4/12 max-w-sm mx-auto">Change password</h2>
        <div class="md:w-5/12 w-full md:pl-9 max-w-sm mx-auto space-y-5 md:inline-flex pl-2">
          <input v-model="user.password"
                 :class="{'border border-red-500' : errors.password}"
                 @keydown="errors.password=''"
                 type="password"
                 class="w-11/12 focus:outline-none  rounded focus:text-gray-600 p-2 ml-4"
                 placeholder="New" />
        </div>
        <div class="md:w-3/12 text-center md:pl-6 flex space-x-3 items-center">
          <button
              class="text-white hover:bg-indigo-600 w-full mx-auto max-w-sm rounded-md text-center bg-indigo-400 py-2 px-4 inline-flex items-center justify-center focus:outline-none md:float-right">
            Update
          </button>


        </div>
      </div>
      <hr />
    </form>

  </section>
</template>

<script>
export default {
  name: "Edit",
  data() {
    return {
      user: {},
      errors: {},
      notify: false
    }
  },
  async created() {
    const {data} = await axios.get(`/api/user/edit/${this.$route.params.id}`)
    this.user = data;

  },
  methods: {
    async updateUser() {
      try {
        await axios.put("/api/user/update", this.user);
        await  this.notifyMessage("Updated!")
      } catch ({response}) {
        this.errors = response.data.errors;
      }
    },

    async notifyMessage($message) {
      this.notify = $message;
      setTimeout(() => {
        this.notify = false;
      }, 2500)
    }
  },

}
</script>

<style scoped>

</style>