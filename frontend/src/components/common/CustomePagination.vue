<template>
<div class="custom-pagination-container" v-if="totalCount > 0">
    <div class="footer-pagination" cols="12">
      <div class="footer-pagination-para pagination-enteries" v-if="showDataDetails">
        {{ pagination }}
      </div>
      <div class="footer-pagination-items" :class="position" >
        <template v-if="showCustomPageItems">
        </template>

        <!-- Previous button -->
        <v-btn :disabled="this.page == 1" @click="prevPageButton" class="prev-btn" elevation="0"><v-icon class="pagination-btn-icon">mdi-chevron-left</v-icon></v-btn>
        <v-pagination
          :value="page"
          @input="$emit('page-number-changed' , $event)"
          @next="$emit('next-page-changed')"
          @previous="$emit('previous-page-changed')"
          :total-visible="7"
          :length="pageCount"
          color="#5C94A3"
          class="custom-pagination"
          circle
        ></v-pagination>
        <!-- Next button -->
        <v-btn :disabled="this.page === pageCount || totalCount == 0" @click="nextPageButton" class="next-btn" elevation="0"><v-icon class="pagination-btn-icon">mdi-chevron-right</v-icon></v-btn>
      </div>
    </div>
  </div>
</template>

<script>


/**
 * Description: This pagination component is used throughout the application to maintain the styling. The component 
   can show current page text based on prop, page buttons and items per page textfield.
 */

export default {
  name:'pagination',
  props: {
    page:{
      type : Number,
      default : 0
    },
    pageCount:{
      type : Number,
      default : 0
    },
    itemsPerPage:{
      type : Number,
      default : 0
    },
    totalCount:{
      type : Number,
      default : 0
    },
    showDataDetails:{
      type : Boolean,
      default : true,
    },
    showCustomPageItems:{
      type : Boolean,
      default : true,
    },
    position:{
      type : String,
      default : 'justify-end',
    },
  },
  methods:{

    /**
     * handle items per page proprty. Change data when items per page changes
     */
    itemsPage(event) {
      if (event) {
        this.itemPerPage = parseInt(event);
        this.$emit('items-per-page-change' , parseInt(event) )
      }
    },

    /**
     * previous button click handler
     */
    prevPageButton(){
      let prepage = this.page - 1 
      if( this.page > 1 ){
        this.$emit('prev-page-change', prepage)
      }
    },
    /**
     * next button click hanlder
     */
    nextPageButton(){ 
      let newpage = this.page + 1
      if(this.page < this.pageCount){
        this.$emit('next-page-change' , newpage)
      }
    }
  },
  computed : {
    pagination(){
      return  this.totalCount > 0
            ? "Showing " +
              (this.page * this.itemsPerPage - this.itemsPerPage + 1) +
              " to " +
              (this.page * this.itemsPerPage <= this.totalCount
                ? this.page * this.itemsPerPage
                : this.totalCount) +
              " of " +
              this.totalCount
            : "No Records to show"
    }
  }
};
</script>
