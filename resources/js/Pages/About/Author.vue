<template>
    <Head title="About Author" />
    <nav-bar />
    

    <div class="mx-4 md:mx-12  my-6 flex flex-col space-y-6">
        <h1 class="text-4xl font-bold"> About The Author  </h1>

        <div class="my-6">
            <img src="/images/tbom-author.jpg" class="h-24 w-24 p-1 rounded-full" />
            <h4 class="text-lg font-semibold my-6"> Dr Mogaji Hammed - Biograghy </h4>
            <p class="font-light md:mr-40"> Hammed O. Mogaji holds a First-Class Bachelor’s Degree in Zoology, Masters and PhD in Parasitology with Distinction. 
                He hails from Abeokuta-South in Ogun State, Southwest Nigeria, and currently works as a lecturer in the Department of Animal and Environmental Biology at Federal University Oye-Ekiti, 
                in Nigeria. He also holds a postdoctoral fellowship in epidemiology at Institute of Collective Health, Salvador, Brazil. His research interest revolves around neglected tropical diseases,
                 including mapping and exploration of socio-economic and ecological determinants of disease transmission. In the past years, 
                 he has focused on understudying disease programs and identifying bottlenecks limiting them. Before joining the university, he was a research scientist with the Spatial Parasitology and 
                 Health GIS group in Abeokuta and a field officer with MITOSATH. He has actively participated in the implementation of NTDs control program involving training of health workers and drug distributors across several endemic communities.
                  He currently serves as a research support officer to MITOSATH. In 2012, he won the prestigious WHO/TDR grant for his Masters’ program in infectious diseases and another WHO/TDR Research Capacity Strengthening grant in 2015. He was part of the researchers that piloted the IR Toolkit in Dhaka and the maiden Principles in Implementation Research course at the African Regional Training Centre, Accra. Mogaji is also a grantee of Royal Society of Tropical Medicine and Hygiene (RSTMH) and Crown Prince Court of Abu Dhabi in 2020. He has a very deep passion for Global Health, most especially in areas involving strengthening community awareness and participation in disease control program. He piloted outreach programs on Malaria, NTDs and COVID-19 in Ogun and Ekiti States, Nigeria between 2015 and 2021, and was recently awarded the 2021 ASTMH Committee on Global Health Travel award for his commitment to a career in Global Health. He was also awarded the 2021 ASTMH TropMed Microgrant to promote visibility and participation in the 2021 conference. He also won the prestigious American Society of Tropical Medicine and Hygiene Young Investigators Award in 2021. His idea titled the “T-BOM Model” was selected as one of the winning ideas in the 2021 TDR-Africa Global Contest to promote research mentorship globally. Mogaji is well published in over 42 peer-reviewed journals with representations in local and international conferences in over 5 countries. He is a reviewer for over 10 reputable journals including PloS NTDs, PLoS ONE, Parasites and Vectors, BMC Public Health, Parasite Epidemiology and Control, Frontier’s in Public Health and Nigerian Journal of Parasitology to mention a few. He is also a member of some National and International scientific societies including the TDR Global, American Society of Tropical Medicine and Hygiene, Royal Society of Tropical Medicine and Hygiene, British Society for Parasitology, Parasitology and Public Health Society of Nigeria, iCHORDS, Global Schistosomiasis Alliance and American Society of Microbiology. Mogaji was recently appointed as a Global Assessor for grants, travel awards and events abstract for the prestigious Royal Society of Tropical Medicine and Hygiene, and a member of the Conference Management Committee for Parasitology and Public Health Society of Nigeria.
            </p>
            

        </div>
    </div>

    <Footer />
</template>



<script>
    import { defineComponent } from 'vue'
    import { Head, Link } from '@inertiajs/inertia-vue3';
    import NavBar from '@/Pages/Partials/NavBar.vue';
     import Footer from '@/Pages/Partials/Footer.vue';
   

    export default defineComponent({
        components: {
            Head,
            Link,
           
            NavBar,
            Footer,
            
        },

    
    })
</script>
