<template>
  <div>
    <v-tooltip dark color="#525d81" v-if="hasPermission" bottom>
      <template v-slot:activator="{ on, attrs }">
        <span v-if="text" v-bind="attrs" v-on="on">{{ text }}</span>
        <v-icon
          v-if="icon"
          class="action-icons font-12"
          :color="
            icon == 'information-outline' || icon == 'cancel' ? 'red' : ''
          "
          :class="{
            'icon-primary': item == 'initiated',
            'icon-green': item == 'ok',
            'icon-green-active': item == 'Active',
            'icon-orange': item == 'fraudulent',
            'copy-icon' : item == 'Copy',
            'icon-red': item == 'failed',
            'icon-red-inactive': item == 'Inactive',
            'icon-purple': item == 'declined',
            'icon-pending': item == 'pending',
            'icon-yellow': item == 'disputed',
          }"
          v-bind="attrs"
          v-on="on"
          @click="$emit('on-icon-click')"
          >mdi-{{ icon }}</v-icon
        >
      </template>
      <span class="text-capitalize">{{ tooltip ? tooltip : 'Empty' }}</span>
    </v-tooltip>
  </div>
</template>
<script>
/**
 * this component helps to render tooltip alogn with text
 */
export default {
  name: "TextTooltip",
  props: {
    text: {
      type: String,
      default: "",
    },
    item: {
      type: String,
      default: "",
    },
    hasPermission: {
      type: Boolean,
      default: true,
    },
    icon: {
      type: String,
      default: "",
    },
    tooltip: {
      type: String,
      default: "",
    },
  },
};
</script>
<style>
.copy-icon{
  font-size: 14px !important;
}
.icon-green {
  color: rgb(89, 206, 89) !important;
  font-size: 12px !important;
}
.icon-green-active {
  color: rgb(89, 206, 89) !important;
  font-size: 12px !important;
}
.icon-red {
  color: rgb(241, 101, 101) !important;
  font-size: 12px !important;
}
.icon-red-inactive {
  color: rgb(241, 101, 101) !important;
  font-size: 12px !important;
}
.icon-primary {
  color: rgb(105, 105, 238) !important;
  font-size: 12px !important;
}
.icon-orange {
  color: orange !important;
  font-size: 12px !important;
}
.icon-pending {
  color: rgb(72, 72, 72) !important;
  font-size: 12px !important;
}
.icon-yellow {
  color: yellow !important;
  font-size: 12px !important;
}
.icon-grey {
  color: rgb(233, 233, 233) !important;
  font-size: 12px !important;
}
.icon-purple {
  color: purple !important;
  font-size: 12px !important;
}
</style>