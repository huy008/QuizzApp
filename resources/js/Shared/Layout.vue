<script setup >
     import Header from '@/Shared/Header.vue';
     import Footer from '@/Shared/Header.vue';
</script>

<template>
  <div class="container">
     <Header/>
    <slot/>
    <Footer/>
  </div>
</template>