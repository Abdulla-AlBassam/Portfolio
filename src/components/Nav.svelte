<script lang="ts">
  import { onMount } from "svelte";
  import ThemeToggle from "./ThemeToggle.svelte";

  let scrolled = $state(false);
  let mobileOpen = $state(false);

  const links = [
    { label: "About", href: "#about" },
    { label: "Skills", href: "#skills" },
    { label: "Education", href: "#education" },
    { label: "Contact", href: "#contact" },
  ];

  onMount(() => {
    const handleScroll = () => {
      scrolled = window.scrollY > 20;
    };
    window.addEventListener("scroll", handleScroll, { passive: true });
    return () => window.removeEventListener("scroll", handleScroll);
  });

  function closeMobile() {
    mobileOpen = false;
  }
</script>

<nav
  class="fixed top-0 left-0 right-0 z-50 transition-all duration-300 {scrolled
    ? 'bg-bg/80 backdrop-blur-xl border-b border-border'
    : 'bg-transparent'}"
  aria-label="Main navigation"
>
  <div class="section-container flex items-center justify-between h-16">
    <!-- Logo -->
    <a
      href="#"
      class="font-mono text-sm font-semibold tracking-wider text-text-primary hover:text-accent transition-colors"
    >
      abdulla<span class="text-accent">.</span>dev
    </a>

    <!-- Desktop links -->
    <div class="hidden md:flex items-center gap-8">
      {#each links as link}
        <a
          href={link.href}
          class="text-sm text-text-secondary hover:text-text-primary transition-colors duration-200"
        >
          {link.label}
        </a>
      {/each}
      <a
        href="/cv.pdf"
        target="_blank"
        rel="noopener noreferrer"
        class="text-sm px-4 py-1.5 rounded-full border border-accent/30 text-accent hover:bg-accent/10 transition-all duration-200"
      >
        Resume
      </a>
      <ThemeToggle />
    </div>

    <!-- Mobile toggle -->
    <div class="flex items-center gap-2 md:hidden">
      <ThemeToggle />
      <button
        onclick={() => (mobileOpen = !mobileOpen)}
        class="p-2 text-text-secondary hover:text-text-primary transition-colors"
        aria-label={mobileOpen ? "Close menu" : "Open menu"}
        aria-expanded={mobileOpen}
      >
        <svg
          xmlns="http://www.w3.org/2000/svg"
          width="20"
          height="20"
          viewBox="0 0 24 24"
          fill="none"
          stroke="currentColor"
          stroke-width="2"
          stroke-linecap="round"
          stroke-linejoin="round"
        >
          {#if mobileOpen}
            <path d="M18 6 6 18"></path>
            <path d="m6 6 12 12"></path>
          {:else}
            <path d="M4 12h16"></path>
            <path d="M4 6h16"></path>
            <path d="M4 18h16"></path>
          {/if}
        </svg>
      </button>
    </div>
  </div>

  <!-- Mobile menu -->
  {#if mobileOpen}
    <div
      class="md:hidden border-t border-border bg-bg/95 backdrop-blur-xl"
    >
      <div class="section-container py-6 flex flex-col gap-4">
        {#each links as link}
          <a
            href={link.href}
            onclick={closeMobile}
            class="text-base text-text-secondary hover:text-text-primary transition-colors py-2"
          >
            {link.label}
          </a>
        {/each}
        <a
          href="/cv.pdf"
          target="_blank"
          rel="noopener noreferrer"
          onclick={closeMobile}
          class="text-base text-accent hover:text-accent-hover transition-colors py-2"
        >
          Resume
        </a>
      </div>
    </div>
  {/if}
</nav>
