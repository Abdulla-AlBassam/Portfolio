<script lang="ts">
  import SectionHeading from "./SectionHeading.svelte";
  import ScrollReveal from "./ScrollReveal.svelte";

  const certifications = [
    {
      name: "CCNA-Level Knowledge",
      issuer: "Self-study & Coursework",
      description:
        "Routing, switching, VLANs, OSPF, ACLs, NAT, and network troubleshooting.",
    },
  ];
</script>

<section id="certifications" class="py-24">
  <div class="section-container">
    <ScrollReveal>
      <SectionHeading
        label="Certifications"
        title="Industry Credentials"
        description="Professional certifications and training that validate my skills."
      />
    </ScrollReveal>

    <div class="max-w-2xl mx-auto grid gap-4">
      {#each certifications as cert, i}
        <ScrollReveal delay={i * 100}>
          <div
            class="p-6 rounded-xl border border-border bg-bg-surface flex flex-col sm:flex-row sm:items-start gap-4 hover:border-border-hover transition-colors duration-200"
          >
            <div
              class="p-2.5 rounded-lg bg-accent/10 border border-accent/20 shrink-0"
            >
              <svg
                xmlns="http://www.w3.org/2000/svg"
                width="22"
                height="22"
                viewBox="0 0 24 24"
                fill="none"
                stroke="currentColor"
                stroke-width="2"
                stroke-linecap="round"
                stroke-linejoin="round"
                class="text-accent"
              >
                <circle cx="12" cy="8" r="6"></circle>
                <path d="M15.477 12.89 17 22l-5-3-5 3 1.523-9.11"></path>
              </svg>
            </div>
            <div>
              <h3 class="font-semibold text-lg">{cert.name}</h3>
              <p class="text-xs font-mono text-text-muted mt-0.5">
                {cert.issuer}
              </p>
              <p class="text-sm text-text-secondary mt-2 leading-relaxed">
                {cert.description}
              </p>
            </div>
          </div>
        </ScrollReveal>
      {/each}

      <!-- Placeholder for future certs -->
      <ScrollReveal delay={certifications.length * 100}>
        <div
          class="flex items-center justify-center p-6 rounded-xl border border-dashed border-border text-text-muted text-sm"
        >
          More certifications in progress
        </div>
      </ScrollReveal>
    </div>
  </div>
</section>
