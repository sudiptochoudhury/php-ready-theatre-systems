<template>
  <div class="app">
    <div class="header">
      <label>Select Layout </label>
        <select v-model="layout" class="layout" @change="renderSeats">
            <option disabled value="">
                {{ selectMessage }}
            </option>
            <option v-for="layoutItem in layouts" v-bind:value="layoutItem.LayoutName">
              {{ layoutItem.LayoutName }}
            </option>
        </select>

        <label class="sectionName" v-show="!!layout">Section Name: <span>{{ sectionName }}</span></label>

    </div>
    <div class="auditorium">
      <div class="seats" v-show="!!layout">
      </div>
    </div>
    <div class="footer"></div>
  </div>
</template>

<script src="./script.js"></script>
<style src="./style.scss" lang="scss"></style>