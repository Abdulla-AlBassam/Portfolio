<script lang="ts">
  import SectionHeading from "./SectionHeading.svelte";
  import ScrollReveal from "./ScrollReveal.svelte";

  const timeline = [
    {
      period: "2023 — Present",
      title: "BSc Networks & Cyber Security",
      institution: "Northumbria University, Newcastle",
      description:
        "Studying network architecture, ethical hacking, digital forensics, and security operations. Hands-on labs in penetration testing and incident response.",
      modules: [
        "Network Security",
        "Ethical Hacking",
        "Digital Forensics",
        "Cryptography",
        "Operating Systems",
        "Routing & Switching",
      ],
    },
  ];

</script>

<section id="education" class="py-24">
  <div class="section-container">
    <ScrollReveal>
      <SectionHeading
        label="Education"
        title="Where I'm Learning"
        description="Building a strong foundation in networking and security through
          academic study and self-driven projects."
      />
    </ScrollReveal>

    <!-- Timeline -->
    <div class="relative max-w-2xl mx-auto">
      <!-- Vertical line -->
      <div
        class="absolute left-4 md:left-6 top-0 bottom-0 w-px bg-gradient-to-b from-accent/50 via-border to-transparent"
        aria-hidden="true"
      ></div>

      {#each timeline as item, i}
        <ScrollReveal delay={i * 150}>
          <div class="relative pl-12 md:pl-16 pb-12">
            <!-- Dot on timeline -->
            <div
              class="absolute left-2.5 md:left-4.5 top-1 w-3 h-3 rounded-full bg-accent border-2 border-bg"
              aria-hidden="true"
            ></div>

            <!-- Period -->
            <span class="text-xs font-mono text-accent">{item.period}</span>

            <!-- Card -->
            <div
              class="mt-2 p-5 rounded-xl border border-border bg-bg-surface"
            >
              <h3 class="text-lg font-semibold">{item.title}</h3>
              <p class="text-sm text-text-secondary mt-0.5">
                {item.institution}
              </p>
              <p class="text-sm text-text-secondary mt-3 leading-relaxed">
                {item.description}
              </p>

              {#if item.modules.length > 0}
                <div class="mt-4">
                  <p class="text-xs font-mono text-text-muted uppercase tracking-wider mb-2">
                    Key Modules
                  </p>
                  <div class="flex flex-wrap gap-2">
                    {#each item.modules as mod}
                      <span
                        class="px-2.5 py-1 text-xs font-mono rounded bg-white/5 text-text-secondary border border-white/5"
                      >
                        {mod}
                      </span>
                    {/each}
                  </div>
                </div>
              {/if}
            </div>
          </div>
        </ScrollReveal>
      {/each}
    </div>

  </div>
</section>
