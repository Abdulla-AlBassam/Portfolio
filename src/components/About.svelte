<script lang="ts">
  import SectionHeading from "./SectionHeading.svelte";
  import ScrollReveal from "./ScrollReveal.svelte";
</script>

<section id="me" class="py-24">
  <div class="section-container">
    <ScrollReveal>
      <SectionHeading
        label="About"
        title="A Bit About Me"
      />
    </ScrollReveal>

    <ScrollReveal delay={100}>
      <div
        class="max-w-3xl mx-auto flex flex-col md:flex-row items-center md:items-start gap-8"
      >
        <!-- Photo placeholder -->
        <div class="shrink-0">
          <div
            class="w-48 h-48 rounded-2xl border border-border bg-bg-surface flex items-center justify-center overflow-hidden"
          >
            <!-- Replace this div with an <img> tag when you have your photo -->
            <div class="text-center">
              <svg
                xmlns="http://www.w3.org/2000/svg"
                width="40"
                height="40"
                viewBox="0 0 24 24"
                fill="none"
                stroke="currentColor"
                stroke-width="1.5"
                stroke-linecap="round"
                stroke-linejoin="round"
                class="text-text-muted mx-auto"
              >
                <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                <circle cx="12" cy="7" r="4"></circle>
              </svg>
              <p class="text-xs text-text-muted mt-2">Your photo</p>
            </div>
          </div>
        </div>

        <!-- Bio -->
        <div class="text-center md:text-left">
          <p class="text-text-secondary leading-relaxed">
            I'm Abdulla Al-Bassam, a cybersecurity student at Northumbria
            University studying Networks &amp; Cyber Security. I'm passionate
            about understanding how systems work — and how they break. From
            penetration testing to building network architectures, I love
            getting hands-on with real problems.
          </p>
          <p class="text-text-secondary leading-relaxed mt-4">
            Outside of security, I build things — web apps, mobile apps, and
            tools that solve real problems. I believe the best way to learn
            is by doing, so most of my knowledge comes from personal projects
            and self-driven exploration.
          </p>
          <p class="text-text-secondary leading-relaxed mt-4">
            When I'm not at a terminal, you'll find me exploring new
            technologies, contributing to open source, or learning something
            new about the ever-evolving cybersecurity landscape.
          </p>
        </div>
      </div>
    </ScrollReveal>
  </div>
</section>
