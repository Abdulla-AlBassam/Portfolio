<script lang="ts">
  import { onMount } from "svelte";

  let isDark = $state(true);

  onMount(() => {
    // Check saved preference or default to dark
    const saved = localStorage.getItem("theme");
    if (saved === "light") {
      isDark = false;
      document.body.classList.add("light");
    }
  });

  function toggle() {
    isDark = !isDark;
    if (isDark) {
      document.body.classList.remove("light");
      localStorage.setItem("theme", "dark");
    } else {
      document.body.classList.add("light");
      localStorage.setItem("theme", "light");
    }
  }
</script>

<button
  onclick={toggle}
  class="relative p-2 rounded-lg transition-colors duration-200 hover:bg-white/5 focus:outline-none focus-visible:ring-2 focus-visible:ring-accent"
  aria-label={isDark ? "Switch to light mode" : "Switch to dark mode"}
>
  {#if isDark}
    <!-- Sun icon -->
    <svg
      xmlns="http://www.w3.org/2000/svg"
      width="18"
      height="18"
      viewBox="0 0 24 24"
      fill="none"
      stroke="currentColor"
      stroke-width="2"
      stroke-linecap="round"
      stroke-linejoin="round"
      class="text-text-secondary hover:text-text-primary transition-colors"
    >
      <circle cx="12" cy="12" r="4"></circle>
      <path d="M12 2v2"></path>
      <path d="M12 20v2"></path>
      <path d="m4.93 4.93 1.41 1.41"></path>
      <path d="m17.66 17.66 1.41 1.41"></path>
      <path d="M2 12h2"></path>
      <path d="M20 12h2"></path>
      <path d="m6.34 17.66-1.41 1.41"></path>
      <path d="m19.07 4.93-1.41 1.41"></path>
    </svg>
  {:else}
    <!-- Moon icon -->
    <svg
      xmlns="http://www.w3.org/2000/svg"
      width="18"
      height="18"
      viewBox="0 0 24 24"
      fill="none"
      stroke="currentColor"
      stroke-width="2"
      stroke-linecap="round"
      stroke-linejoin="round"
      class="text-light-text-secondary hover:text-light-text transition-colors"
    >
      <path d="M12 3a6 6 0 0 0 9 9 9 9 0 1 1-9-9Z"></path>
    </svg>
  {/if}
</button>
