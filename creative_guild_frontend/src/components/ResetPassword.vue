<template>
  <div class="wrapper-signin">
    <img src="../../cg-logo.png" alt="Logo" class="logo" />
    <h1 class="primary-font">Password Reset Request</h1>
    <h2 class="secondary-font">
      Have an Account?
      <router-link class="cg-link" to="/">Login</router-link>
    </h2>
    <div v-if="message" class="error-message">{{ message }}</div>

    <div class="form-container">
      <form @submit.prevent="handleSubmit" class="login-form">
        <div class="form-field-wrapper">
          <label for="email" class="secondary-font">Email</label>
          <input
            type="email"
            id="email"
            v-model="formData.email"
            placeholder="smith@gmail.com"
            class="cg-input"
            required
          />
        </div>
        <div class="secondary-font cg-button-wrapper">
          <button type="submit" class="cg-button">Submit Reset Request</button>
        </div>
      </form>
    </div>
  </div>
</template>

<script setup lang="ts">
import { useRouter } from 'vue-router'
import { ref } from 'vue'

const message = ref('')
const router = useRouter()
const formData = ref({
  email: ''
})

const handleSubmit = async () => {
  try {
    const response = await fetch('http://localhost:8888/api/reset_password', {
      method: 'POST',
      body: JSON.stringify(formData.value),
      headers: {
        'Content-Type': 'application/json'
      }
    })

    if (!response.ok) {
      console.log(response)
      throw new Error('Invalid email')
    }

    const data = await response.json()
    console.log(data.token)
    console.log('reset token:', JSON.stringify(data.token))
    console.log(data)
    // const token = JSON.stringify(data.token)
    // localStorage.setItem('token', token)
    router.push('/change_password')
  } catch (error) {
    console.error('Error logging in:', error)
    message.value = 'error'
  }
}
</script>
