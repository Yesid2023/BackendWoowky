<template>
    <form>
      <div class="offcanvas offcanvas-end offcanvas-booking" tabindex="-1" id="pet-notes-form" aria-labelledby="form-offcanvasLabel">
        <div class="offcanvas-header border-bottom">
          <h5 class="offcanvas-title" id="form-offcanvasLabel">  


             <span>Notes List</span>
             <!-- <span>{{Username}}</span> -->
         
          </h5>
          <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
  
        <div class="offcanvas-body">
  
          <div class="form-group">
            <div v-if="!IsLoading" class="d-grid">
              <div class="d-flex flex-column">
                <div class="mb-4">
                </div>
              </div>
              <div v-if="NoteList.length > 0" class="list-group list-group-flush">
                 <div  v-for="(item, index) in NoteList" :key="item" class="list-group-item bg-soft-primary text-body rounded mb-3 border-0">
                   <div class="mb-3">
                     <h6 class="mb-0">Title </h6>
                     <div>{{ item.title }}</div>
                   </div>
                   <div>
                     <h6 class="mb-0">Description </h6>
                     <div>{{ item.description }}</div>
                   </div>
                 </div>      
             </div>
             <div v-else class="text-center">
                   <p>Notes are not available</p>
             </div>
            </div>
            <div v-else class="text-center"> Proccessing.... </div>
          </div>
        </div>
      </div>
    </form>
  
  
  </template>

  <script setup>
  import { ref, onMounted,watch} from 'vue'
  import { GET_PET_NOTES_URL } from '../constant/pets'
  import { useModuleId, useRequest,useOnOffcanvasHide,useOnOffcanvasShow} from '@/helpers/hooks/useCrudOpration'

  const props = defineProps({

  id: { type: Number, default: 0 }
})

  // Request
  const { deleteRequest, getRequest, updateRequest } = useRequest()

  const Username = ref(null)
  
  const NoteList = ref([])

  const currentId = ref(props.id)

  const IsLoading=ref(false)

watch(
  () => props.id,
  (value) => {
    IsLoading.value=true;
    currentId.value = value
 

    if (value > 0) {
      getRequest({ url: GET_PET_NOTES_URL, id: value }).then((res) => {
        if (res.status && res.data) {

             IsLoading.value=false

            NoteList.value=res.data;
         
        //    Username.value = res.data.pet.name + "'s Notes list";
   
        }
      })
    } 
  }
)


  

  
  const removePet = (value, message) => {
  
        confirmSwal({title: message}).then((result) => {
          if(!result.isConfirmed) return
          deleteRequest({ url: DELETE_PET, id: value }).then((res) => {
            if(res.status) {
              Swal.fire({
                title: 'Deleted',
                text: res.message,
                icon: "success"
              })
              selectedpets.value = res.data
              assign_ids.value = res.data.map((item) => item.id)
              renderedDataTable.ajax.reload(null, false)
             
            }
          })
        })
      }
  

  </script>
 
  