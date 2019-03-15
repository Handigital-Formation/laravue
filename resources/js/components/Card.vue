<template>
  <div class="card red lighten-2">
    <div class="card-body">
      <span class="card-title">{{ pensee.user.name }} - <small>{{ pensee.user.email }}</small></span>
      <p>{{ pensee.text }}</p>
      <p>
        <small>{{ pensee.created_at }}</small>
      </p>
      <div v-if="deletable" class="card-action">
        <a href="#" @click.prevent="deletePensee" class="btn btn-danger">Supprimer cette pensée</a>
      </div>
    </div>
  </div>
</template>
<script>
export default {
  props: ["pensee", "user"],
  computed: {
    deletable() {
      return this.pensee.user_id == this.user;
    }
  },
  methods: {
    deletePensee() {
      this.$emit("deletePensee", this.pensee.id);
    }
  }
};
</script>
