<script lang="ts">
  import SectionHeading from "./SectionHeading.svelte";
  import ScrollReveal from "./ScrollReveal.svelte";

  const categories = [
    {
      name: "Cybersecurity",
      icon: "M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z",
      color: "from-cyan-500/10 to-cyan-500/5",
      borderColor: "border-cyan-500/20",
      skills: [
        "Penetration Testing",
        "Threat Modeling",
        "Network Security",
        "OSINT",
      ],
    },
    {
      name: "Networking",
      icon: "M5 12h14M12 5l7 7-7 7",
      color: "from-blue-500/10 to-blue-500/5",
      borderColor: "border-blue-500/20",
      skills: ["CCNA", "OSPF", "VPNs", "ACLs", "MPLS"],
    },
    {
      name: "Development",
      icon: "M16 18l6-6-6-6M8 6l-6 6 6 6",
      color: "from-violet-500/10 to-violet-500/5",
      borderColor: "border-violet-500/20",
      skills: ["Next.js", "Python", "Tailwind CSS", "Supabase", "Git"],
    },
    {
      name: "Tools",
      icon: "M14.7 6.3a1 1 0 0 0 0 1.4l1.6 1.6a1 1 0 0 0 1.4 0l3.77-3.77a6 6 0 0 1-7.94 7.94l-6.91 6.91a2.12 2.12 0 0 1-3-3l6.91-6.91a6 6 0 0 1 7.94-7.94l-3.76 3.76z",
      color: "from-emerald-500/10 to-emerald-500/5",
      borderColor: "border-emerald-500/20",
      skills: ["Burp Suite", "Nmap", "Metasploit", "GNS3", "Wireshark", "Figma"],
    },
  ];
</script>

<section id="skills" class="py-24">
  <div class="section-container">
    <ScrollReveal>
      <SectionHeading
        label="Skills"
        title="What I Work With"
        description="A blend of cybersecurity, networking, and development — built through hands-on projects and continuous learning."
      />
    </ScrollReveal>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
      {#each categories as category, i}
        <ScrollReveal delay={i * 100}>
          <div
            class="group relative rounded-xl border {category.borderColor} bg-gradient-to-br {category.color} p-6 hover:border-border-hover transition-all duration-300"
          >
            <!-- Category header -->
            <div class="flex items-center gap-3 mb-5">
              <div
                class="p-2 rounded-lg bg-white/5 border border-white/5"
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
                  class="text-accent"
                >
                  <path d={category.icon}></path>
                </svg>
              </div>
              <h3 class="font-semibold text-lg">{category.name}</h3>
            </div>

            <!-- Skill tags -->
            <div class="flex flex-wrap gap-2">
              {#each category.skills as skill}
                <span
                  class="px-3 py-1.5 text-sm font-mono rounded-md bg-white/5 text-text-secondary border border-white/5 hover:text-text-primary hover:border-white/10 transition-colors"
                >
                  {skill}
                </span>
              {/each}
            </div>
          </div>
        </ScrollReveal>
      {/each}
    </div>
  </div>
</section>
