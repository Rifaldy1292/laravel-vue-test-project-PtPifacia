<template>
  <div class="container mx-auto px-4 py-8">
    <!-- Header dan Tombol Add Role -->
    <div class="flex justify-between items-center mb-6">
      <h2 class="text-2xl font-semibold text-gray-900">Role Management</h2>
      <button
        @click="openAddRoleModal"
        class="bg-blue-600 text-white px-6 py-3 rounded-md shadow-md hover:bg-blue-500 transition-all"
      >
        Add Role
      </button>
    </div>

    <!-- Tabel Role Management -->
    <div class="overflow-x-auto bg-white shadow rounded-lg">
      <table class="min-w-full text-sm text-gray-500 table-auto">
        <thead class="bg-gray-100">
          <tr>
            <th
              class="px-6 py-3 text-xs font-semibold text-gray-600 uppercase tracking-wider text-left w-1/2"
            >
              Role
            </th>
            <th
              class="px-6 py-3 text-xs font-semibold text-gray-600 uppercase tracking-wider text-left w-1/2"
            >
              Actions
            </th>
          </tr>
        </thead>
        <tbody>
          <tr
            v-for="role in roles"
            :key="role.id"
            class="hover:bg-gray-50 border-t border-gray-200"
          >
            <td class="px-6 py-4 text-sm font-medium text-gray-700 w-1/2">
              {{ role.name }}
            </td>
            <td class="px-6 py-4 w-1/2 flex justify-start space-x-2">
              <button
                @click="openEditRoleModal(role)"
                class="text-yellow-600 hover:text-yellow-500 hover:bg-yellow-100 px-4 py-2 rounded-md transition-all"
              >
                Edit
              </button>
              <button
                @click="tryDeleteRole(role.id)"
                class="text-red-600 hover:text-red-500 hover:bg-red-100 px-4 py-2 rounded-md transition-all"
              >
                Delete
              </button>
            </td>
          </tr>
        </tbody>
      </table>
    </div>

    <!-- Modal Add Role -->
    <div
      v-if="isAddRoleModalOpen"
      class="fixed inset-0 bg-gray-600 bg-opacity-50 flex justify-center items-center z-50"
    >
      <div class="bg-white p-6 rounded-lg shadow-lg w-96">
        <h3 class="text-xl font-semibold mb-4 text-gray-900">Add Role</h3>

        <!-- Input untuk Role Name -->
        <input
          type="text"
          v-model="newRoleName"
          placeholder="Role Name"
          class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-600 mb-4"
        />

        <!-- Input untuk Deskripsi -->
        <textarea
          v-model="newRoleDescription"
          placeholder="Role Description (JSON format)"
          class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-600 mb-4"
          rows="3"
        ></textarea>

        <!-- Dropdown atau Checkbox untuk Status Aktif -->
        <div class="mb-4">
          <label class="text-sm font-medium text-gray-600">Status</label>
          <div class="mt-2">
            <label class="inline-flex items-center">
              <input
                type="checkbox"
                v-model="newRoleStatus"
                class="form-checkbox h-5 w-5 text-blue-600 border-gray-300 rounded focus:ring-blue-600"
              />
              <span class="ml-2 text-gray-700">Active</span>
            </label>
          </div>
        </div>

        <div class="flex justify-end space-x-4">
          <button
            @click="closeAddRoleModal"
            class="bg-gray-500 text-white px-4 py-2 rounded-md hover:bg-gray-400 transition-all"
          >
            Cancel
          </button>
          <button
            @click="addRole"
            class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-500 transition-all"
          >
            Add
          </button>
        </div>
      </div>
    </div>

    <!-- Modal Edit Role -->
    <div
      v-if="isEditRoleModalOpen"
      class="fixed inset-0 bg-gray-600 bg-opacity-50 flex justify-center items-center z-50"
    >
      <div class="bg-white p-6 rounded-lg shadow-lg w-96">
        <h3 class="text-xl font-semibold mb-4 text-gray-900">Edit Role</h3>

        <!-- Input untuk Role Name -->
        <input
          type="text"
          v-model="editedRoleName"
          placeholder="Role Name"
          class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-yellow-600 mb-4"
        />

        <!-- Input untuk Deskripsi -->
        <textarea
          v-model="editedRoleDescription"
          placeholder="Role Description (JSON format)"
          class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-yellow-600 mb-4"
          rows="3"
        ></textarea>

        <!-- Dropdown atau Checkbox untuk Status Aktif -->
        <div class="mb-4">
          <label class="text-sm font-medium text-gray-600">Status</label>
          <div class="mt-2">
            <label class="inline-flex items-center">
              <input
                type="checkbox"
                v-model="editedRoleStatus"
                class="form-checkbox h-5 w-5 text-yellow-600 border-gray-300 rounded focus:ring-yellow-600"
              />
              <span class="ml-2 text-gray-700">Active</span>
            </label>
          </div>
        </div>

        <div class="flex justify-end space-x-4">
          <button
            @click="closeEditRoleModal"
            class="bg-gray-500 text-white px-4 py-2 rounded-md hover:bg-gray-400 transition-all"
          >
            Cancel
          </button>
          <button
            @click="saveEditedRole"
            class="bg-yellow-600 text-white px-4 py-2 rounded-md hover:bg-yellow-500 transition-all"
          >
            Save
          </button>
        </div>
      </div>
    </div>

    <!-- Modal Delete Confirmation -->
    <div
      v-if="isDeleteConfirmModalOpen"
      class="fixed inset-0 bg-gray-600 bg-opacity-50 flex justify-center items-center z-50"
    >
      <div class="bg-white p-6 rounded-lg shadow-lg w-96">
        <h3 class="text-xl font-semibold mb-4 text-gray-900">
          Are you sure you want to delete this role?
        </h3>

        <div class="flex justify-end space-x-4">
          <button
            @click="closeDeleteConfirmModal"
            class="bg-gray-500 text-white px-4 py-2 rounded-md hover:bg-gray-400 transition-all"
          >
            Cancel
          </button>
          <button
            @click="deleteRoles(roleToDelete.id)"
            class="bg-red-600 text-white px-4 py-2 rounded-md hover:bg-red-500 transition-all"
          >
            Delete
          </button>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { onMounted, ref } from "vue";
import {
  getAllRoles,
  createRole,
  deleteRole,
  updateRole,
} from "../services/role/role.js";

const roles = ref([]);
const token = localStorage.getItem("token");
const roleToDelete = ref(null);

const isAddRoleModalOpen = ref(false);
const isEditRoleModalOpen = ref(false);
const isDeleteConfirmModalOpen = ref(false);

const newRoleName = ref("");
const newRoleDescription = ref("");
const newRoleStatus = ref(false);

const editedRoleName = ref("");
const editedRoleDescription = ref("");
const editedRoleStatus = ref(false);

const fetchRoles = async () => {
  try {
    const rolesData = await getAllRoles(token);
    roles.value = rolesData;
  } catch (error) {
    console.error("Failed to fetch roles:", error);
  }
};

const openAddRoleModal = () => {
  isAddRoleModalOpen.value = true;
};

const closeAddRoleModal = () => {
  isAddRoleModalOpen.value = false;
  newRoleName.value = "";
  newRoleDescription.value = "";
};

const openEditRoleModal = (role) => {
  editedRoleName.value = role.name;

  editedRoleStatus.value = role.is_active;
  roleToDelete.value = role;
  isEditRoleModalOpen.value = true;
};

const closeEditRoleModal = () => {
  isEditRoleModalOpen.value = false;
};

const addRole = async () => {
  if (token) {
    try {
      const roleData = {
        name: newRoleName.value,
        description: { description: newRoleDescription.value },
        is_active: newRoleStatus.value,
      };
      await createRole(roleData, token);
      fetchRoles();
      closeAddRoleModal();
    } catch (error) {
      console.error("Failed to create role:", error);
    }
  }
};

const saveEditedRole = async () => {
  if (roleToDelete.value) {
    try {
      const roleData = {
        name: editedRoleName.value,
        description: { description: editedRoleDescription.value },
        is_active: editedRoleStatus.value,
      };
      console.log(roleData);
      await updateRole(roleToDelete.value.id, roleData, token);
      fetchRoles();
      closeEditRoleModal();
    } catch (error) {
      console.error("Failed to update role:", error);
    }
  }
};

const tryDeleteRole = (roleId) => {
  roleToDelete.value = roles.value.find((role) => role.id === roleId);
  isDeleteConfirmModalOpen.value = true;
};

const deleteRoles = async (roleId) => {
  try {
    console.log(roleId, token);
    await deleteRole(roleId, token);
    console.log(roleId, token);

    closeDeleteConfirmModal();
    fetchRoles();
  } catch (error) {
    console.error("Failed to delete role:", error);
  }
};

const closeDeleteConfirmModal = () => {
  isDeleteConfirmModalOpen.value = false;
  roleToDelete.value = null;
};

onMounted(fetchRoles);
</script>

<style scoped>
/* Additional custom styles for modal background */
</style>
