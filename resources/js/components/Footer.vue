<template>
    <div class="footer">
        <div class="footer-top">
            <div class="container">
                <div class="row">
                    <div class="footer-logo-content col-xxl-3 col-xl-3 col-lg-3 col-md-5 col-sm-6">
                        <div class="footer-logo">
                            <Logo />
                            <div class="content">
                                <p class="info">High-performance PCs and must-have tech accessories.</p>
                                <SocialLinks />
                            </div>
                        </div>
                    </div>
                    <div class="company col-xxl-2 col-xl-2 col-lg-3 col-md-4 col-sm-6">
                        <FooterLinks title="Company" :links="companyLinks" />
                    </div>
                    <div class="store col-xxl-3 col-xl-3 col-lg-3 col-md-3 col-sm-6">
                        <FooterLinks title="Store" :links="storeLinks" />
                    </div>
                    <div class="support col-xxl-1 col-xl-1 col-lg-3 col-md-3 col-sm-6">
                        <FooterLinks title="Support" :links="supportLinks" />
                    </div>
                    <div class="info col-xxl-3 col-xl-3 col-lg-3 col-md-5 col-sm-6">
                        <ContactInfo />
                    </div>
                </div>
            </div>
        </div>
        <div class="footer-bottom">
            <div class="container">
                <div class="row">
                    <div class="copyrights col-sm-6">
                        <p>© 2024 <a href="/">MilanKV</a> All Rights Reserved.</p>
                    </div>
                    <div class="payments col-sm-6">
                        <PaymentMethods />
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import Logo from './Logo.vue';
import SocialLinks from './SocialLinks.vue';
import FooterLinks from './FooterLinks.vue';
import ContactInfo from './ContactInfo.vue';
import PaymentMethods from './PaymentMethods.vue';

export default {
    name: 'Footer',
    components: {
        Logo,
        SocialLinks,
        FooterLinks,
        ContactInfo,
        PaymentMethods
    },
    data() {
        return {
            companyLinks: [
                { text: 'About Us', href: '#' },
                { text: 'Careers', href: '#' },
                { text: 'Store Locations', href: '#' },
                { text: 'Blog', href: '#' }
            ],
            storeLinks: [
                { text: 'Game & Video', href: '#' },
                { text: 'Phone & Tablets', href: '#' },
                { text: 'Computers & Laptop', href: '#' },
                { text: 'Sport Watches', href: '#' }
            ],
            supportLinks: [
                { text: 'FAQs', href: '#' },
                { text: 'Reviews', href: '#' },
                { text: 'Contact Us', href: '#' },
                { text: 'Shipping', href: '#' }
            ]
        };
    }
};
</script>