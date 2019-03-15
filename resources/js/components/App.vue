<template>
  <div class="container">
    <!-- Button trigger modal -->
    <button
      type="button"
      class="btn btn-primary"
      data-toggle="modal"
      data-target="#ajoutPensee"
    >Ajouter une pensée</button>
    <p></p>

    <div v-for="pensee in pensees">
      <card :pensee="pensee" :user="user" @deletePensee="deletePensee"></card>
    </div>

    <!-- Modal -->
    <div
      class="modal fade"
      id="ajoutPensee"
      tabindex="-1"
      role="dialog"
      aria-labelledby="ajoutPenseeLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <form v-on:submit.prevent="addPensee">
            <div class="modal-header">
              <h5 class="modal-title" id="ajoutPenseeLabel">Ajout d'une pensée</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <textarea id="pensee" v-model="texte" style="width:100%;min-height:120px;"></textarea>
              <p class="red-text">{{ error }}</p>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
              <button type="submit" class="btn btn-primary">Ajouter</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
import Card from "./Card";
export default {
  resource: null,
  data() {
    return {
      pensees: [],
      user: 0,
      texte:'',
      error:'',
    };
  },
  mounted() {
    this.resource = this.$resource("/pensees{/id}");
    this.resource.get().then(response => {
      this.pensees = response.body[0];
      this.user = response.body[1];
    });
  },
  components: {
    Card
  },
  methods: {
    deletePensee(id) {
      this.resource.delete({ id: id }).then(response => {
        let index = _.findIndex(this.pensees, function(o) {
          return o.id == id;
        });
        this.pensees.splice(index, 1);
      });
    },
    addPensee() {
      this.resource.save({ text: this.texte }).then(
        response => {
          $('#ajoutPensee').modal('hide');
          this.texte = "";
          this.error = "";
          this.pensees.unshift(response.body);
        },
        response => {
          this.error = response.body.errors.text[0];
        }
      );
    }
  }
};
</script>
