<script lang="ts">
  import { onMount } from "svelte";
  import HeroBackground from "./HeroBackground.svelte";

  let mounted = $state(false);

  onMount(() => {
    // Small delay for entrance animation
    setTimeout(() => {
      mounted = true;
    }, 100);
  });
</script>

<section
  id="about"
  class="relative min-h-screen flex items-center justify-center overflow-hidden"
>
  <HeroBackground />

  <!-- Gradient overlay at bottom for smooth transition -->
  <div
    class="absolute bottom-0 left-0 right-0 h-32 bg-gradient-to-t from-bg to-transparent pointer-events-none"
    aria-hidden="true"
  ></div>

  <div class="section-container relative z-10 py-20">
    <div class="max-w-3xl">
      <!-- Greeting tag -->
      <div
        class="inline-flex items-center gap-2 px-3 py-1 rounded-full border border-border text-xs font-mono text-text-secondary mb-6 transition-all duration-700 {mounted
          ? 'opacity-100 translate-y-0'
          : 'opacity-0 translate-y-4'}"
      >
        <span class="w-1.5 h-1.5 rounded-full bg-accent animate-glow-pulse"
        ></span>
        Open to opportunities
      </div>

      <!-- Name -->
      <h1
        class="text-4xl sm:text-5xl md:text-6xl font-bold tracking-tight leading-tight transition-all duration-700 delay-100 {mounted
          ? 'opacity-100 translate-y-0'
          : 'opacity-0 translate-y-4'}"
      >
        Hi, I'm
        <span class="gradient-text">Abdulla</span>
      </h1>

      <!-- Tagline -->
      <p
        class="mt-4 text-lg sm:text-xl text-text-secondary max-w-xl leading-relaxed transition-all duration-700 delay-200 {mounted
          ? 'opacity-100 translate-y-0'
          : 'opacity-0 translate-y-4'}"
      >
        Cybersecurity student &amp; builder. I break things to understand how
        they work, then build them back better. Studying
        <span class="text-text-primary font-medium"
          >Networks &amp; Cyber Security</span
        > at Northumbria University.
      </p>

      <!-- CTA buttons -->
      <div
        class="mt-8 flex flex-wrap gap-4 transition-all duration-700 delay-300 {mounted
          ? 'opacity-100 translate-y-0'
          : 'opacity-0 translate-y-4'}"
      >
        <a
          href="#contact"
          class="inline-flex items-center gap-2 px-6 py-3 bg-accent text-bg font-medium text-sm rounded-lg hover:bg-accent-hover transition-colors duration-200"
        >
          Get in touch
          <svg
            xmlns="http://www.w3.org/2000/svg"
            width="16"
            height="16"
            viewBox="0 0 24 24"
            fill="none"
            stroke="currentColor"
            stroke-width="2"
            stroke-linecap="round"
            stroke-linejoin="round"
          >
            <path d="m6 17 5-5-5-5"></path>
            <path d="m13 17 5-5-5-5"></path>
          </svg>
        </a>
        <a
          href="#skills"
          class="inline-flex items-center gap-2 px-6 py-3 border border-border text-text-secondary font-medium text-sm rounded-lg hover:border-border-hover hover:text-text-primary transition-all duration-200"
        >
          View my work
        </a>
      </div>

      <!-- Quick stats / social proof -->
      <div
        class="mt-12 flex flex-wrap gap-8 text-sm transition-all duration-700 delay-[400ms] {mounted
          ? 'opacity-100 translate-y-0'
          : 'opacity-0 translate-y-4'}"
      >
        <div>
          <span class="text-text-primary font-semibold font-mono text-lg"
            >BSc</span
          >
          <p class="text-text-muted mt-0.5">Networks &amp; Cyber Security</p>
        </div>
        <div class="w-px bg-border"></div>
        <div>
          <span class="text-text-primary font-semibold font-mono text-lg"
            >CCNA</span
          >
          <p class="text-text-muted mt-0.5">Level Knowledge</p>
        </div>
        <div class="w-px bg-border"></div>
        <div>
          <span class="text-text-primary font-semibold font-mono text-lg"
            >Builder</span
          >
          <p class="text-text-muted mt-0.5">Security Tools &amp; Web Apps</p>
        </div>
      </div>
    </div>
  </div>
</section>
