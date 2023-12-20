<template>
    <form @submit="formSubmit">
      <div>
        <CardTitle title="App Configuration Settings" icon="fa-solid fa-sliders"></CardTitle>
      </div>
     <div class="form-group">
        <div class="d-flex justify-content-between align-items-center">
          <label class="form-label" for="category-enable_event">{{ $t('setting_integration_page.lbl_enable_event') }} </label>
          <div class="form-check form-switch">
            <input class="form-check-input" :true-value="1" :false-value="0" :value="is_event" :checked="is_event == 1 ? true : false" name="is_event" id="category-is_event" type="checkbox" v-model="is_event" />
          </div>
        </div>
      </div>

      <div class="form-group">
        <div class="d-flex justify-content-between align-items-center">
          <label class="form-label" for="category-enable_blog">{{ $t('setting_integration_page.lbl_enable_blog') }} </label>
          <div class="form-check form-switch">
            <input class="form-check-input" :true-value="1" :false-value="0" :value="is_blog" :checked="is_blog == 1 ? true : false" name="is_blog" id="category-is_blog" type="checkbox" v-model="is_blog" />
          </div>
        </div>
      </div>

      <div class="form-group">
        <div class="d-flex justify-content-between align-items-center">
          <label class="form-label" for="category-enable_user_push_notification">{{ $t('setting_integration_page.lbl_enable_user_push_notification') }} </label>
          <div class="form-check form-switch">
            <input class="form-check-input" :true-value="1" :false-value="0" :value="is_user_push_notification" :checked="is_user_push_notification == 1 ? true : false" name="is_user_push_notification" id="category-is_user_push_notification" type="checkbox" v-model="is_user_push_notification" />
          </div>
        </div>
      </div>

      <div class="form-group">
        <div class="d-flex justify-content-between align-items-center">
          <label class="form-label" for="category-enable_provider_push_notification">{{ $t('setting_integration_page.lbl_enable_provider_push_notification') }} </label>
          <div class="form-check form-switch">
            <input class="form-check-input" :true-value="1" :false-value="0" :value="is_provider_push_notification" :checked="is_provider_push_notification == 1 ? true : false" name="is_provider_push_notification" id="category-is_provider_push_notification" type="checkbox" v-model="is_provider_push_notification" />
          </div>
        </div>
      </div>
    
    
  
      <SubmitButton :IS_SUBMITED="IS_SUBMITED"></SubmitButton>
    </form>
  </template>
  <script setup>
  import { ref, watch } from 'vue'
  import CardTitle from '@/Setting/Components/CardTitle.vue'
  import * as yup from 'yup'
  import { useField, useForm } from 'vee-validate'
  import { STORE_URL, GET_URL } from '@/vue/constants/setting'
  import { useRequest } from '@/helpers/hooks/useCrudOpration'
  import { onMounted } from 'vue'
  import { createRequest } from '@/helpers/utilities'
  import SubmitButton from './Forms/SubmitButton.vue'
  import InputField from '@/vue/components/form-elements/InputField.vue'
  const { storeRequest } = useRequest()
  const IS_SUBMITED = ref(false)
  //  Reset Form
  const setFormData = (data) => {
    resetForm({
      values: {

        is_event: data.is_event || 0,
        is_blog: data.is_blog || 0,
        is_user_push_notification: data.is_user_push_notification || 0,
        is_provider_push_notification: data.is_provider_push_notification || 0,
       
      }
    })
  }
  //validation
  const validationSchema = yup.object({
   
  })
  const { handleSubmit, errors, resetForm, validate } = useForm({validationSchema})
  const errorMessages = ref({})
  const { value: is_event } = useField('is_event')
  const { value: is_blog } = useField('is_blog')
  const { value: is_user_push_notification } = useField('is_user_push_notification')
  const { value: is_provider_push_notification } = useField('is_provider_push_notification')
  
  


  // message
  const display_submit_message = (res) => {
    IS_SUBMITED.value = false
    if (res.status) {
      window.successSnackbar(res.message)
    } else {
      window.errorSnackbar(res.message)
      errorMessages.value = res.errors
    }
  }
  
  //fetch data
  const data = [
    'is_event',
    'is_blog',
    'is_user_push_notification',
    'is_provider_push_notification',
   
  ]
  
 
  onMounted(() => {
  
    const customData = [
      ...data,

    ].join(",")
  
    createRequest(GET_URL(customData)).then((response) => {
      setFormData(response)
    })
  })
  
  //Form Submit
  const formSubmit = handleSubmit((values) => {
    IS_SUBMITED.value = true
    const newValues = {}
    Object.keys(values).forEach((key) => {
      if(values[key] !== '') {
        newValues[key] = values[key] || ''
      }

      console.log(newValues)
    })
    storeRequest({
      url: STORE_URL, 
      body: newValues
    }).then((res) => display_submit_message(res))
  })
  
  defineProps({
    label: { type: String, default: '' },
    modelValue: { type: String, default: '' },
    placeholder: { type: String, default: '' },
    errorMessage: { type: String, default: '' },
    errorMessages: { type: Array, default: () => [] }
  })
  </script>
  