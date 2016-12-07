<template>
  <div class="col-md-offset-3 col-md-6">
    <ul class="list-group event-list">
      <li class="list-group-item list-group-item-info">All active events</li>
      <li v-for="(event, key) in events" class="list-group-item">
        <a v-bind:href="event.id">
          {{ event.title }}<span class="badge goer-count">{{ event.goer_count }}</span>
          <span class="glyphicon glyphicon-chevron-right pull-right"></span>
        </a>
      </li>
    </ul>
  </div>
</template>

<script>
  export default {
    mounted: function() {
      this.getEventsList();
    },
    data: function() {
      return {
        events : []
      }
    },
    methods: {
      getEventsList : function() {
        this.$http.get('/api/signup.events').then(function(response) {
          var data = response.data;
          if (data.ok) {
            return this.$set(this,'events', data.data);
          }
          this.$emit('api-error', data.error);
        });
      }
    }
  }
</script>
