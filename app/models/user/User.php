<?php
    class User {
        private $id;
        private $lastName;
        private $firstName;
        private $email;
        private $passWord;
        private $role;

        public function __construct($id, $lastName, $firstName, $email, $passWord, $role) {
            $this->id = $id;
            $this->lastName = $lastName;
            $this->firstName = $firstName;
            $this->email = $email;
            $this->passWord = $passWord;
            $this->role = $role;
        }
        

        /**
         * Get the value of id
         */
        public function getId()
        {
                return $this->id;
        }

        /**
         * Set the value of id
         *
         * @return  self
         */
        public function setId($id)
        {
                $this->id = $id;

                return $this;
        }

        /**
         * Get the value of lastName
         */
        public function getLastName()
        {
                return $this->lastName;
        }

        /**
         * Set the value of lastName
         *
         * @return  self
         */
        public function setLastName($lastName)
        {
                $this->lastName = $lastName;

                return $this;
        }

        /**
         * Get the value of firstName
         */
        public function getFirstName()
        {
                return $this->firstName;
        }

        /**
         * Set the value of firstName
         *
         * @return  self
         */
        public function setFirstName($firstName)
        {
                $this->firstName = $firstName;

                return $this;
        }

        /**
         * Get the value of email
         */
        public function getEmail()
        {
                return $this->email;
        }

        /**
         * Set the value of email
         *
         * @return  self
         */
        public function setEmail($email)
        {
                $this->email = $email;

                return $this;
        }

        /**
         * Get the value of passWord
         */
        public function getPassWord()
        {
                return $this->passWord;
        }

        /**
         * Set the value of passWord
         *
         * @return  self
         */
        public function setPassWord($passWord)
        {
                $this->passWord = $passWord;

                return $this;
        }

        /**
         * Get the value of role
         */
        public function getRole()
        {
                return $this->role;
        }

        /**
         * Set the value of role
         *
         * @return  self
         */
        public function setRole($role)
        {
                $this->role = $role;

                return $this;
        }
    }
?>