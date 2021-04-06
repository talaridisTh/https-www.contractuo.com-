<template>
  <section class="text-gray-600 body-font">
    <div class="container px-5 py-24 mx-auto">
      <div class="lg:w-2/3 w-full mx-auto overflow-auto">
        <div class="text-green-400 text-2xl my-3" v-show="notify">deleted!</div>
        <table class="table-auto w-full text-left whitespace-no-wrap">
          <thead>
          <tr>
            <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100 rounded-tl rounded-bl">
              id
            </th>
            <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">Name</th>
            <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">Email</th>
            <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">Created</th>
            <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">
              Updated
            </th>
            <th class="w-10 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100 rounded-tr rounded-br pr-3">
              Action
            </th>
          </tr>
          </thead>
          <tbody class="text-white">
          <tr v-for="(user ,key) in users " :key="user.id">
            <td class="px-4 py-3">{{ user.id }}</td>
            <td class="px-4 py-3">{{ user.name }}</td>
            <td class="px-4 py-3">{{ user.email }}</td>
            <td class="px-4 py-3 text-lg ">{{ formatDate(user.created_at) }}</td>
            <td class="px-4 py-3 text-lg ">{{ formatDate(user.updated_at) }}</td>
            <td class="px-4 py-3 text-lg ">
              <div class="btn-group " role="group">
                <router-link :to="{name: 'edit', params: { id: user.id }}" class="btn btn-success">Edit</router-link>
                <button class="btn btn-danger" @click="destroyUser(user.id)">Delete</button>
              </div>
            </td>
          </tr>
          </tbody>
        </table>
      </div>
    </div>
  </section>

</template>

<script>

export default {
  name: "Show",
  data() {
    return {
      users: [],
      notify: false
    }
  },
  async created() {
    let {data} = await axios.get("/api/user");

    this.users = data.users

  },
  methods: {
    formatDate(date) {
      return moment(date, 'YYYY-MM-DD HH:mm:ss').format('HH:mm:ss');
    },

    async destroyUser(id) {
      await axios.delete(`/api/user/delete/${id}`)
      let i = this.users.map(data => data.id).indexOf(id);
      this.users.splice(i, 1)

      await this.notifyMessage("Deleted!");

    },

    async notifyMessage($message) {
      this.notify = $message;
      setTimeout(() => {
        this.notify = false;
      }, 2500)
    }

  }


}
</script>

<style scoped>

</style>