<template>
  <div class="profile-container">
    <div class="profile" v-if="user">
      <div class="profile-info">
        <div class="profile-picture">
          <img :src="user.profile_picture" alt="Profile Picture" />
        </div>
        <div class="profile-details">
          <h2 class="primary-font">{{ user.name }}</h2>
          <div class="bio">
            <div>
              <div class="profile-details-title">Bio</div>
              <p class="secondary-font">{{ user.bio }}</p>
            </div>
            <div>
              <div class="profile-details-title">Phone</div>
              <p class="secondary-font highlight-font">{{ user.phone }}</p>
              <div class="profile-details-title">Email</div>
              <p class="secondary-font highlight-font">{{ user.email }}</p>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div v-else>
      <p>Loading user profile...</p>
    </div>
    <div class="albums">
      <div class="album-container" v-if="albums.length">
        <div class="album" v-for="album in albums" :key="album.id">
          <div class="album-image">
            <img :src="album.img" alt="Album Image" />
            <p class="album-name">{{ album.title }}</p>
          </div>
          <div class="album-details">
            <p class="album-description">{{ album.description }}</p>
            <div class="album-footer">
              <span v-if="album.featured" class="featured-icon">❤️</span>
              <span class="album-date">{{ album.date }}</span>
            </div>
          </div>
        </div>
      </div>
      <div v-else>
        <p>No albums found.</p>
      </div>
    </div>
  </div>
</template>

<script setup lang="ts">
import { ref, onMounted } from 'vue'
import { useRoute } from 'vue-router'

interface Album {
  id: number
  title: string
  description: string
  img: string
  date: string
  featured: boolean
}

interface User {
  id: number
  name: string
  email: string
  phone: string
  bio: string
  profile_picture: string
  albums: Album[]
}

const user = ref<User | null>(null)
const albums = ref<Album[]>([])
const route = useRoute()

const userId = Number(route.params.id)

onMounted(() => {
  fetch(`http://localhost:8888/api/user/${userId}`)
    .then((response) => {
      if (!response.ok) {
        throw new Error('Failed to fetch user profile')
      }
      return response.json()
    })
    .then((data) => {
      user.value = data.user
      albums.value = data.user.albums
    })
    .catch((error) => {
      console.error('Error fetching user profile:', error)
      // Provide user feedback about the error, e.g., display a message
    })
})
</script>

<style scoped>
.profile-container {
  display: flex;
  flex-direction: column;
  align-items: center;
  width: 70%; /* Adjust the width as needed */
}

.album-container {
  display: flex;
  flex-wrap: wrap;
  justify-content: space-between;
}

.profile {
  background-color: #f9f9f9;
  border-radius: 10px;
  padding: 20px;
  margin-bottom: 20px;
}

.profile-info, .albums {
  display: flex;
  align-items: center;
  width: 100%;
}

.profile-info {
  align-items: flex-start;
}

.profile-picture img {
  border-radius: 50%;
  width: 100px;
  height: 100px;
  margin-right: 20px;
}

.profile-details {
  flex-grow: 1;
}

.profile-details h2 {
  font-weight: 500;
}

.profile-details .bio {
  display: flex;
}

.highlight-font{
  color: rgb(244, 63, 93);
}

.profile-details-title{
  font-size: 14px;
  font-weight: 300;
}

.profile-details p {
  margin-bottom: 5px;
}

.album {
  width: calc(33% - 10px);
  margin-bottom: 20px;
  background-color: #f9f9f9;
  border-radius: 10px;
}

.album img {
  width: 100%;
  height: 200px;
  border-radius: 10px 10px 0 0;
}

.album-image {
  position: relative;
}

.album-name {
  position: absolute;
  bottom: 5px;
  margin: 0px;
  color: white;
  font-size: 20px;
  font-weight: bold;
  padding: 10px;
}

.album-details {
  padding: 10px;
}

.album-description {
  margin-bottom: 10px;
}

.album-footer {
  display: flex;
  justify-content: space-between;
  align-items: center;
}

.featured-icon {
  color: red;
}

.album-date {
  font-size: 0.8rem;
}
</style>
