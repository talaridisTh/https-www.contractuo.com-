<template>
  <section>
    <div class="px-10 flex items-center py-3 border-b border-gray-300 ">

      <div class="flex-1">
        <h1 class="text-4xl text-gray-200">Test</h1>
      </div>

      <div class="flex-1 space-x-3">
        <i data-feather="user"></i>
        <i data-feather="user"></i>
      </div>

    </div>

    <section class="flex">
      <aside class="w-1/5 flex flex-col space-y-4 px-10  ">
        <div class="text-lg font-semibold text-gray-200 mt-10 space-y-1 cursor-pointer">
          <span
              @click="isOpen=!isOpen"
              :class="{'text-blue-300':isOpen}"
              class="hover:text-blue-300"
          >User</span>
          <transition name="fade">
            <ul v-show="isOpen" class="pl-3 space-y-1">
              <li>
                <router-link to="/create">create</router-link>
              </li>
              <li>
                <router-link to="/user">show</router-link>
              </li>
            </ul>
          </transition>
        </div>
      </aside>

      <div class="w-4/5 mt-10">
        <router-view></router-view>
      </div>

    </section>

  </section>
</template>
<script>


export default {
  data() {
    return {
      isOpen: false
    }
  },
  components: {}
}
</script>


<style>
.fade-enter-active, .fade-leave-active {
  transition: opacity .5s;
}

.fade-enter, .fade-leave-to /* .fade-leave-active below version 2.1.8 */
{
  opacity: 0;
}
</style>