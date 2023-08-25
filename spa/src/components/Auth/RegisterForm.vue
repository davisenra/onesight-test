<script setup></script>

<template>
    <div>
        <form>
            <div class="form-control w-full max-w-sm">
                <label class="label">
                    <span class="label-text">Name</span>
                </label>
                <input type="text" class="input input-bordered" />
            </div>
            <div class="form-control w-full max-w-sm">
                <label class="label">
                    <span class="label-text">Email</span>
                </label>
                <input type="text" class="input input-bordered" />
            </div>
            <div class="form-control w-full max-w-sm">
                <label class="label">
                    <span class="label-text">Password</span>
                </label>
                <input type="password" class="input input-bordered" />
            </div>
            <button class="btn btn-success btn-wide mt-6" type="submit">Register</button>
        </form>
    </div>
</template>
